<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $province=[
            'خراسان رضوی',
            'تهران',
            'شیراز',
            'اصفهان',
            'آذربایجان شرقی',

        ];


//        foreach ($province as $provinceName=>$options){
//
//            Province::create([
//                'title' => $provinceName,
//
//            ]);
//            $this->command->info('add' . $provinceName . 'province');
//
//        }



    }
}
