<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=[
            'کمدی',
            'خانوادگی',
            'جنایی',
            'معمایی',
            'سیاسی',
            'اجتماعی',
            'موزیکال',
        ];

        foreach ($categories as $category){

            Category::create([
                'name' => $category
            ]);
            $this->command->info('add' . $category . ' category');
        }
    }
}
