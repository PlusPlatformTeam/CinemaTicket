<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->call(CharactersSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(OptionsSeeder::class);
        $this->call(CinemasSeeder::class);

        Schema::enableForeignKeyConstraints();


    }
}
