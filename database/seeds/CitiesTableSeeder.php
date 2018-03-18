<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cities=[
            [
                'name'=>'Dayrout',
                'governate_id'=>3
            ],
             [
                'name'=>'Al-2osya',
                'governate_id'=>3
            ],
            [
                'name'=>'Maloy',
                'governate_id'=>4
            ],
            [
                'name'=>'Samalood',
                'governate_id'=>4
            ],
        ];

        foreach ($cities as $key => $value) {
            City::create($value);
 }
        
        
    }
}
