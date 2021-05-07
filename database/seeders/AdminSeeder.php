<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/admins.json');
        $data = json_decode($json);

        foreach ($data as $obj) {
            $user = User::create([
                'name' => $obj->name,
                'email' => $obj->email,
                'username' => $obj->username,
                'password' => Hash::make($obj->password),
                'active' => 1,
                'email_verified_at' => Carbon::now()
            ]);

            $user->assignRole(Role::findByName('admin'));
        }
    }
}
