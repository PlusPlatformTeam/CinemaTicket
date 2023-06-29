<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharactersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $characters=[

            'پژمان جمشیدی'=>['avatar'=>null , 'city_id' =>2, 'description' => "بازیگری بسیار فعال در همه فیلم های موجود" , 'birthDay' => null ],
            'بهرام افشاری'=>['avatar'=>null , 'city_id' =>2, 'description' => "بازیگری قدبلند و کمدینی جذاب" , 'birthDay' => null ],
            'طناز طباطبایی'=>['avatar'=>null , 'city_id' =>2, 'description' => "بازیگری قدرتمند در ایفای نقش ها" , 'birthDay' => null ],
            'بهاره کیان افشار'=>['avatar'=>null , 'city_id' =>2, 'description' => "بازیگری قدرتمند در نقش های جدی" , 'birthDay' => null ],
            'سحر دولتشاهی'=>['avatar'=>null , 'city_id' =>2, 'description' => "بازیکری خاص و قدرتمند" , 'birthDay' => null ],

        ];

//        foreach ($characters as $characterName=>$options){
//
//            Character::create([
//                'name' => $characterName,
//                'city_id' =>$options['city_id'],
//                'avatar' => $options['avatar'],
//                'birthDay' =>$options['address'],
//                'description' =>$options['description'],
//
//            ]);
//            $this->command->info('add' . $characterName . ' character');
//        }

    }
}
