<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ClinicServiceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CitySeeder::class,
            ClinicSeeder::class,
            AppointmentStatusSeeder::class,
            PaymentMethodSeeder::class,
            PaymentStatusSeeder::class,
            UserTypeSeeder::class,
            UserSeeder::class,
            TicketStatusSeeder::class,
            ClinicServiceSeeder::class
        ]);
    }
}
