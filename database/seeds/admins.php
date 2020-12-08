<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class admins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=1;$i<=10;$i++){

            DB::table('admins')->insert([
                'username'=>'admin'.$i,
                'password'=>\Hash::make('admin'),
                'ad_name'=>$faker->name
            ]);
        }
    }
}
