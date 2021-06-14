<?php

namespace Src\Api\User\Infrastructure;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Spatie\Permission\Models\Role;
use Src\Api\User\Domain\UserEntity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Src\Api\User\Domain\ValueObjects\Bio;
use Src\Api\User\Domain\ValueObjects\Name;
use Src\Api\User\Domain\ValueObjects\Email;
use Src\Api\User\Domain\ValueObjects\Photo;
use Src\Api\User\Domain\ValueObjects\UserId;
use App\Mail\Api\User\ResetPasswordMailiable;
use Src\Api\Shared\Domain\ValueObjects\Token;
use Src\Api\User\Domain\ValueObjects\Password;
use Src\Api\Shared\Domain\ValueObjects\OtpCode;
use Src\Api\User\Domain\Contracts\UserRepository;
use App\Mail\Api\User\RegisterVerificationMailiable;

final class UserEloquentRepository implements UserRepository
{
    public function createUser(UserEntity $userEntity)
    {
        return User::create([
            'name' => $userEntity->getName()->value(),
            'email' => $userEntity->getEmail()->value(),
            'username' => $userEntity->getUsername()->value(),
            'password' => Hash::make($userEntity->getPassword()->value()),
            'photo' => $userEntity->getPhoto()->value()
        ]);
    }

    public function generatePasswordReset(Email $email, int $expireTime)
    {
        $token = $this->generateToken();

        $user = $this->findByEmail($email);

        $this->savePasswordReset($email, $token);

        $this->sendResetPasswordMail($user, $email, $token, $expireTime);
    }

    public function changeActiveStatus(Email $email, bool $status)
    {
        User::where('email', $email->value())
            ->update([
                'active' => $status,
                'email_verified_at' => Carbon::now()
            ]);
    }

    public function changePassword(Email $email, Password $password)
    {
        User::where('email', $email->value())
            ->update([
                'password' => Hash::make($password->value())
            ]);
    }

    public function updateBio(UserId $userId, Bio $bio)
    {
        User::where('id', $userId->value())
            ->update([
                'bio' => $bio->value()
            ]);
    }

    public function updateProfilePhoto(Photo $photo)
    {
        User::where([
            ['id', Auth::user()->id],
            ['active', true]
        ])->update([
            'photo' => $photo->value()
        ]);
    }

    public function followUser(UserId $followingUserId)
    {
        $user = $this->findById($followingUserId);

        $authUserId = new UserId(Auth::user()->id);
        $authUser = $this->findById($authUserId);

        return $authUser->follow($user);
    }

    public function unfollowUser(UserId $followingUserId)
    {
        $user = $this->findById($followingUserId);

        $authUserId = new UserId(Auth::user()->id);
        $authUser = $this->findById($authUserId);

        return $authUser->unfollow($user);
    }

    public function getFollowings()
    {
        return User::where('id', Auth::user()->id)->first()->followings()->distinct()->get();
    }

    public function sendRegisterEmailVerification(Name $name, Email $email, OtpCode $otpCode, int $expireTime)
    {
        Mail::to($email->value())->send(new RegisterVerificationMailiable($name->value(), $otpCode->value(), $expireTime));
    }

    public function sendResetPasswordMail(User $user, Email $email, Token $token, int $expireTime)
    {
        Mail::to($email->value())->send(new ResetPasswordMailiable($user->name, $token->value(), $expireTime));
    }

    public function generateToken()
    {
        $token = new Token(Str::random(60));
        return $token;
    }

    public function savePasswordReset(Email $email, Token $token)
    {
        PasswordReset::where('email', $email->value())->delete();

        PasswordReset::create([
            'email' => $email->value(),
            'token' => $token->value()
        ]);
    }

    public function getReportedUsers()
    {
        return User::join('reports', 'reports.report_element_id', 'users.id')
            ->join('report_reasons', 'report_reasons.id', '=', 'reports.reason_id')
            ->join('users as report_user', 'report_user.id', '=', 'reports.report_user_id')
            ->select(
                'users.name as reported_user_name',
                'users.email',
                'reports.created_at as report_date',
                'report_reasons.name as reason_name',
                'report_user.name as reporting_user'
            )
            ->where('reports.report_element_type', 'USER')
            ->get();
    }

    public function getNoActiveUsers()
    {
        return User::where('active', intval(false))->get();
    }

    public function deleteUser(UserId $userId)
    {
        $user = $this->findById($userId);
        $user->delete();
    }

    public function checkUserCreationTime(string $creationDate)
    {
        $currentDate  = Carbon::now();

        return $currentDate->diffInMinutes($creationDate);
    }

    public function assignRoles(UserId $userId)
    {
        $this->findById($userId)->assignRole(Role::findByName('regular_user'));
    }

    public function findByEmail(Email $email)
    {
        return User::where('email', $email->value())->first();
    }

    public function findById(UserId $userId)
    {
        return User::where('id', $userId->value())->first();
    }
}
