<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities=[
            'مشهد'=>['province_id'=>1],
            'تهران'=>['province_id'=>2],
            'شیراز'=>['province_id'=>3],
            'اصفهان'=>['province_id'=>4],
            'تبریز'=>['province_id'=>5],
        ];

        foreach ($cities as $cityName=>$options){

            City::create([
                'title' => $cityName,
                'province_id' =>$options['province_id'],


            ]);
            $this->command->info('add' . $cityName . 'City');

        }

    }
}
