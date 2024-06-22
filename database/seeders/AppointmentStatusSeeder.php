<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AppointmentStatus;

class AppointmentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(AppointmentStatus::getAvailableValues() as $status)
            AppointmentStatus::create(
                [ 'status' => $status ]
            );
    }
}
