<?php

use Illuminate\Database\Seeder;
use App\Village;

class VillagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $villages=
        [
            [
                'name'=>'Sanabo',
                'city_id'=>1
            ],
            [
                'name'=>'5arfa',
                'city_id'=>1
            ],
            [
                'name'=>'Sar2na',
                'city_id'=>2
            ],
            [
                'name'=>'El-deer',
                'city_id'=>2
            ],
        ];

        foreach ($villages as $key => $value) {
            Village::create($value);
    }
 }
}