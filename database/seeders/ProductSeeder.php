<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('products')->insert([
           'name' => 'Product 1',
           'details' => 'Product 1 details',
           'amount' => 100.00,
       ]);
       DB::table('products')->insert([
           'name' => 'Product 2',
           'details' => 'Product 2 details',
           'amount' => 200.00,
       ]);
         DB::table('products')->insert([
              'name' => 'Product 3',
              'details' => 'Product 3 details',
              'amount' => 300.00,
         ]);
    }
}
