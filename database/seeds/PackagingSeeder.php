<?php

use Illuminate\Database\Seeder;
use App\Packaging;

class PackagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('pacakagings')->truncate();
        Packaging::create(['id' => '1','name' => 'Plastics','slug' => 'Plastics']);
        Packaging::create(['id' => '2','name' => 'Cardbord','slug' => 'Cardbord']);
        Packaging::create(['id' => '3','name' => 'Crates','slug' => 'Crates']);
        Packaging::create(['id' => '4','name' => 'Self Harvest','slug' => 'SelfHarvest']);
    }
}
