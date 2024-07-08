<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $centers = [
            [
                'name' => 'MyayNiGon',
                'code' => 'MNG',
                'location' => 'Sanchaung, Yangon',
            ],
            [
                'name' => 'Pensodan',
                'code' => 'PSD',
                'location' => 'DownTown, Dagon, Yangon',
            ],
            [
                'name' => 'Mandalay',
                'code' => 'MDY',
                'location' => 'Chan Aye Thar San Township, Mandalay'
            ],
        ];

        foreach ($centers as $center) {
            Center::create($center);
        }
    }
}
