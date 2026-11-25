<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'member_code' => 'P0104092008',
            'name' => 'Admin',
            'email' => 'admin@intellectuals.test',
            'phone' => '081234567890',
            'role' => 'petugas',
            'status' => 'Petugas',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'member_code' => 'A0104092008',
            'name' => 'User',
            'email' => 'user@intellectuals.test',
            'phone' => '089876543210',
            'role' => 'anggota',
            'status' => 'Murid',
            'password' => Hash::make('password'),
        ]);

        $sains = Category::create(['name' => 'Sains']);
        $scifi = Category::create(['name' => 'Sci-Fi']);
        $novel = Category::create(['name' => 'Novel']);

        Book::create([
            'category_id' => $sains->id,
            'title' => 'Kosmos & Waktu',
            'author' => 'Carl Sagan',
            'publication_year' => 2020,
            'pages' => 384,
            'isbn' => '978-602-8519-93-9',
            'stock' => 5,
            'description' => 'Eksplorasi mendalam mengenai alam semesta, evolusi galaksi, dan tempat manusia di dalamnya.',
        ]);

        Book::create([
            'category_id' => $scifi->id,
            'title' => 'Dune: Padang Pasir',
            'author' => 'Frank Herbert',
            'publication_year' => 2021,
            'pages' => 512,
            'isbn' => '978-602-8519-94-6',
            'stock' => 3,
            'description' => 'Kisah epik politik, ekologi, dan perjuangan bertahan hidup di planet gurun Arrakis.',
        ]);

        Book::create([
            'category_id' => $novel->id,
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'publication_year' => 2018,
            'pages' => 529,
            'isbn' => '978-602-8519-95-3',
            'stock' => 4,
            'description' => 'Perjuangan sepuluh anak Belitung dalam mengejar mimpi dan pendidikan di tengah keterbatasan.',
        ]);
    }
}