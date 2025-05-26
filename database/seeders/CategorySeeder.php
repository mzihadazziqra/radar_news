<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Impor model Category
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Olahraga',
            'Teknologi',
            'Politik',
            'Ekonomi',
            'Hiburan',
            'Gaya Hidup',
            'Pendidikan',
            'Internasional'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName, '-') // Membuat slug dari nama kategori
            ]);
        }
    }
}
