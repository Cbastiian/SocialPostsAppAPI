<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use Src\Api\User\Application\NoValidatedUserDeleter;

class DeleteNoActiveUsersJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete_no_active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete inactive users who have not activated their account in the established time.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private NoValidatedUserDeleter $noValidatedUserDeleter;

    public function __construct(NoValidatedUserDeleter $noValidatedUserDeleter)
    {
        parent::__construct();
        $this->noValidatedUserDeleter = $noValidatedUserDeleter;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->noValidatedUserDeleter->__invoke();
    }
}
