<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'All Feature',
            'ExamFee Voucher',
            'Reporting',
            'User Role',
            'Media',
            'Center',
            'SubIncome Expenses',
            'ExchangeRates',
            'Service Types',
            'Exam-Voucher'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


    }
}
