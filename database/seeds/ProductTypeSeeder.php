<?php

use Illuminate\Database\Seeder;
use App\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->truncate();
        ProductType::create(['id' => '1','name' => 'Apples','slug' => 'Apples','type'=>'fruit','marker_url'=>'img/Markers/1.png']);
        ProductType::create(['id' => '2','name' => 'Oranges','slug' => 'Oranges','type'=>'fruit','marker_url'=>'img/Markers/2.png']);
        ProductType::create(['id' => '3','name' => 'Babanas','slug' => 'Babanas','type'=>'fruit','marker_url'=>'img/Markers/3.png']);
        ProductType::create(['id' => '4','name' => 'Peas','slug' => 'Peas','type'=>'vegetable','marker_url'=>'img/Markers/4.png']);
        ProductType::create(['id' => '5','name' => 'Cabbages','slug' => 'Cabbages','type'=>'vegetable','marker_url'=>'img/Markers/5.png']);
        ProductType::create(['id' => '6','name' => 'Spinach','slug' => 'Spinach','type'=>'vegetable','marker_url'=>'img/Markers/6.png']);
        ProductType::create(['id' => '7','name' => 'Tomatoes','slug' => 'Tomatoes','type'=>'vegetable','marker_url'=>'img/Markers/7.png']);
        ProductType::create(['id' => '8','name' => 'Potatoes','slug' => 'Potatoes','type'=>'vegetable','marker_url'=>'img/Markers/8.png']);
        ProductType::create(['id' => '9','name' => 'Carrots','slug' => 'Carrots','type'=>'vegetable','marker_url'=>'img/Markers/9.png']);
        ProductType::create(['id' => '10','name' => 'Grapes','slug' => 'Grapes','type'=>'fruit','marker_url'=>'img/Markers/10.png']);

    }
}
