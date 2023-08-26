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
            ['title' => 'کافی شاپ', 'icon' => "fa-solid fa-mug-saucer"],
            ['title' => 'کارتخوان', 'icon' => "fa-solid fa-credit-card" ],
            ['title' => 'چاپ بلیط', 'icon' => "fa-solid fa-ticket"],
            ['title' => 'کتابخانه', 'icon' => "fa-solid fa-book"],
            ['title' => 'بوفه', 'icon' => "fa-solid fa-bowl-food"]
        ];

        foreach ($options as $option){

            Option::create([
                'title' => $option['title'],
                'icon' =>$option['icon'],
            ]);
            $this->command->info('add' . $option['title'] . ' option');
        }
    }
}
