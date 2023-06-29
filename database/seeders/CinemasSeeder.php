<?php

namespace Database\Seeders;

use App\Models\Cinema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cinemas=[

            'پردیس سینمایی هویزه'=>['city_id'=>1 , 'banner' =>null, 'address' => "چهاراه کلستان" , 'options' => null , 'location' => null,'description' => "بهترین سینمای مشهد",'phone' => "05138437576"],
            'سینما افریقا'=>['city_id'=>1 , 'banner' =>null, 'address' => "میدان شریعتی" , 'options' => null , 'location' => null,'description' => "سینمای نوستالژی زیبا",'phone' => "05138597454"],
            'سینما برفی'=>['city_id'=>1 , 'banner' =>null, 'address' => "جانباز" , 'options' => null , 'location' => null,'description' => "سینمای جدید در مشهد بسیار زیبا",'phone' => "0513714"],

        ];

        foreach ($cinemas as $cinemaName=>$options){

            Cinema::create([
                'title' => $cinemaName,
                'city_id' =>$options['city_id'],
                'banner' => $options['banner'],
                'address' =>$options['address'],
                'options' =>$options['options'],
                'location' =>$options['location'],
                'description' =>$options['description'],
                'phone' =>$options['phone'],

            ]);
            $this->command->info('add' . $cinemaName . ' cinema');
        }
    }
}
