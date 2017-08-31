<?php

use Illuminate\Database\Seeder;
use App\UserRoles;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('user_roles')->truncate();
        UserRoles::create(['id' => '1','name' => 'Seller','slug' => 'Seller']);
        UserRoles::create(['id' => '2','name' => 'Buyer','slug' => 'Buyer']);
        UserRoles::create(['id' => '3','name' => 'Researcher','slug' => 'Researcher']);
        UserRoles::create(['id' => '4','name' => 'Supplier','slug' => 'Seller']);
    }
}
