<?php

namespace App\Console\Commands;

use App\Services\InactiveUsersService;
use Illuminate\Console\Command;


class ActivateUsers extends Command
{

    protected $signature = 'command:activateUsers';


    protected $description = 'automatically activate new users after 48 hrs';
    protected $inactiveUsers;


    public function __construct(InactiveUsersService $InactiveUserService)
    {
        parent::__construct();
        $this->inactiveUsers =$InactiveUserService;
    }

    public function handle()
    {
        $this->inactiveUsers->inactiveUsers();
    }
}
