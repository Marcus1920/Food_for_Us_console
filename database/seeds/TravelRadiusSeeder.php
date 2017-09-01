<?php

use Illuminate\Database\Seeder;
use App\UserTravelRadius;

class TravelRadiusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserTravelRadius::create(['id' => '1','kilometres' => '10km']);
        UserTravelRadius::create(['id' => '2','kilometres' => '20km']);
        UserTravelRadius::create(['id' => '3','kilometres' => '30km']);
        UserTravelRadius::create(['id' => '4','kilometres' => '40km']);
        UserTravelRadius::create(['id' => '5','kilometres' => '50km']);
        UserTravelRadius::create(['id' => '6','kilometres' => '60km']);
        UserTravelRadius::create(['id' => '7','kilometres' => '70km']);
        UserTravelRadius::create(['id' => '8','kilometres' => '80km']);
        UserTravelRadius::create(['id' => '9','kilometres' => '90km']);
        UserTravelRadius::create(['id' => '10','kilometres' => '100km']);
    }
}
