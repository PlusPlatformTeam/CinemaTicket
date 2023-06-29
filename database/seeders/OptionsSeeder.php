<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options=[

            'کافی شاپ'=>['icon'=>"fa-solid fa-mug-saucer" ],
            'کارتخوان'=>['icon'=>"fa-solid fa-credit-card" ],
            'چاپ بلیط'=>['icon'=>"fa-solid fa-ticket" ],
            'کتابخانه'=>['icon'=>"fa-solid fa-book" ],
            'بوفه'=>['icon'=>"fa-solid fa-bowl-food" ],

        ];

        foreach ($options as $optionsName=>$op){

            Option::create([
                'title' => $optionsName,
                'icon' =>$op['icon'],


            ]);
            $this->command->info('add' . $optionsName . ' option');
        }
    }
}
