<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $provinces=[
            'خراسان رضوی',
            'تهران',
            'شیراز',
            'اصفهان',
            'آذربایجان شرقی',

        ];


        foreach ($provinces as $name){

            Province::create([
                'title' => $name,

            ]);
            $this->command->info('add' . $name . 'province');

        }



    }
}
