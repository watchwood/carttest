<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Item::create([
             'name' => 'Widget #1',
             'price' => 9.99,
        ]);
        Item::create([
             'name' => 'Widget #2',
             'price' => 4.99,
        ]);
        Item::create([
             'name' => 'Widget #3',
             'price' => 14.99,
        ]);
    }
}
