<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Remessa Parcial',
            'slug' => Str::slug('Remessa Parcial'),
            'description' => 'Remessa Parcial',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Remessa',
            'slug' => Str::slug('Remessa'),
            'description' => 'Remessa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
