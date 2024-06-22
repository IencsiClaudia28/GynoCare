<?php

namespace Database\Seeders;

use App\Models\ClinicService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClinicServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ClinicService::create([
            'name' => 'Consultație',
            'clinic_id' => 1,
            'price' => 150
        ]);

        ClinicService::create([
            'name' => 'Test Papanicolau',
            'clinic_id' => 1,
            'price' => 200
        ]);

    }
}
