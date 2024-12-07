<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Roman' => 'Livres de fiction et romans',
            'Science' => 'Livres scientifiques et techniques',
            'Histoire' => 'Livres historiques',
            'Informatique' => 'Livres sur la programmation et l\'informatique',
            'Philosophie' => 'Livres de philosophie',
            'Art' => 'Livres sur l\'art et la culture',
            'Éducation' => 'Livres éducatifs et scolaires',
            'Autre' => 'Autres types de livres'
        ];

        foreach ($categories as $name => $description) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description
            ]);
        }
    }
} 