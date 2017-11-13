<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\OverDueCartItemService;

class UnboughtCartItems extends Command
{

    protected $overDue;
    protected $signature = 'command:UnboughCartItems';
    protected $description = 'Remove carts item not bought after 24 hours';

    public function __construct(OverDueCartItemService $OverDueCartItemService)
    {
        $this->overDue  =$OverDueCartItemService;
        parent::__construct();
    }

    public function handle()
    {
        $this->overDue->overDueItems();
    }
}
