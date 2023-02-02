<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'=>'Shiro',
                'price'=>'2',
                'category'=>'Puppi',
                'description'=>'eek dum faltu insan hai',
                'gallery'=>'https://media.istockphoto.com/id/1426996087/photo/cute-corgi-dog-in-fancy-black-hat-sitting-in-autumn-park-with-pumpkin-for-halloween.jpg?s=612x612&w=is&k=20&c=1Tfc4exsHblzXDEuZv9TIz8kBST54tSp_NY29nzBKzg=',
            ],
            [
                'name'=>'Gumpi',
                'price'=>'free',
                'category'=>'Chinki chinese',
                'description'=>'Ee gola se na aaye ',
                'gallery'=>'https://media.istockphoto.com/id/183241512/photo/woman-with-her-dog-at-outdoors-xlarge.jpg?b=1&s=170667a&w=0&k=20&c=zbULnmvjBXmxEot0u2vfv3auGEwu-Pcat4zXelrdjNw=',
            ]
        ]);
    }
}
