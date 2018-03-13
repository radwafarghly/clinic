<?php

use Illuminate\Database\Seeder;
use App\Governate;
class GovernatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $governates=[
            [
                'name'=>'Alexandria'
            ],
             [
                'name'=>'Aswan'
            ],
             [
                'name'=>'Asyut'
            ],
             [
                'name'=>'Beheira'
            ],
             [
                'name'=>'Beni Suef'
            ],
             [
                'name'=>'Cairo'
            ],
             [
                'name'=>'Dakahlia'
            ],
             [
                'name'=>'Damietta'
            ],
             [
                'name'=>'Faiyum'
            ],
             [
                'name'=>'Gharbia'
            ],
             [
                'name'=>'Giza'
            ],
             [
                'name'=>'Ismailia'
            ],
             [
                'name'=>'Kafr El Sheikh'
            ],
            [
                'name'=>'Luxor'
            ],
            [
                'name'=>'Matruh'
            ],
            [
                'name'=>'Minya'
            ],
            [
                'name'=>'Monufia'
            ],
            [
                'name'=>'North Sinai'
            ],
            [
                'name'=>'Port Said'
            ],
            [
                'name'=>'Qalyubia'
            ],
            [
                'name'=>'Qena'
            ],
            [
                'name'=>'Red Sea'
            ],
            [
                'name'=>'Sharqia'
            ],
            [
                'name'=>'Sohag'
            ],
            [
                'name'=>'South Sinai'
            ],
            [
                'name'=>'Suez'
            ],
            [
                'name'=>'Zagazig'
            ],
            [
                'name'=>'El Tor'
            ],
            [
                'name'=>'Hurghada'
            ],
            [
                'name'=>'Banha'
            ],
            [
                'name'=>'Arish'
            ],
            [
                'name'=>'Kharga'
            ],
            [
                'name'=>'Shibin El Kom'
            ],
            [
                'name'=>'Tanta'
            ],
            [
                'name'=>'Mansoura'
            ],
            [
                'name'=>'Damanhur'
            ],
           
        ];

        foreach ($governates as $key => $value) {
               Governate::create($value);
    }
}
}
