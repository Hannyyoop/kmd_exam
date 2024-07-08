<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('exchange_rates')->insert([
            'code' => 'KS',
            'rate' => '1',
        ]);

        DB::table('exchange_rates')->insert([
            'code' => 'US',
            'rate' => '4070',
        ]);
    }
}
