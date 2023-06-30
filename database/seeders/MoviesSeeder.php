<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hashids\Hashids;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
          ['title' => 'شهر هرت', 'info' => 'شهر هرت فیلم خنده دار', 'duration' => 95, 'director' => 'کریم امینی' , 'second_banner' => '0d99b7c0fe14920fd49672301c80bd55.webp', 'main_banner' => '61c743954cdb94971eef102aa91f153f.webp', 'trailer' => '13c6bc1981fe5294db4bd410a2fe5ec852679728-360p.mp4'],
            ['title' => 'آهنگ دونفره', 'info' => 'اهنگ دوفره کمدی', 'duration' => 105, 'director' => 'آرزو ارزانش' , 'second_banner' => 'f743ddf3d18b564b5da28ece7acbaae1.webp', 'main_banner' => 'b31f028944da17dd30f7427bacc1a9e6.webp', 'trailer' => '13c6bc1981fe5294db4bd410a2fe5ec852679721-360p.mp4'],
            ['title' => 'کت چرمی', 'info' => 'کت چرمی', 'duration' => 85, 'director' => 'پیمان معادی' , 'second_banner' => 'ab811aa3b8449f06f046099547baab15.webp', 'main_banner' => 'f6eb27f6c5802c338817d70edac4d5f3.webp', 'trailer' => '13c6bc1981fe5294db4bd410a2fe5ec852679722-360p.mp4'],
            ['title' => 'مصلحت', 'info' => 'مصلجت فیلم سیاسی', 'duration' => 90, 'director' => 'ابراهیم حاتمی کیا' , 'second_banner' => 'b8d7e50f53a6c485042a56c555909487.webp', 'main_banner' => '3a486ed7ceaa4a24e3015413cedb72e3.webp', 'trailer' => '13c6bc1981fe5294db4bd410a2fe5ec852679723-360p.mp4'],
        ];

        $i = 1;
        foreach ($movies as $movie){
            $slug = new Hashids();
            Movie::create([
                'slug' => $slug->encode($i),
                'title' => $movie['title'],
                'info' => $movie['info'],
                'duration' => $movie['duration'],
                'director' => $movie['director'],
                'second_banner' => 'public/movies/'.$slug->encode($i).'/'. $movie['second_banner'],
                'main_banner' => 'public/movies/'.$slug->encode($i).'/'. $movie['main_banner'],
                'trailer' => 'public/movies/'.$slug->encode($i).'/'. $movie['trailer'],
            ]);
            $i++;
            $this->command->info('add' . $movie['title'] . 'movie' );

        }
    }
}
