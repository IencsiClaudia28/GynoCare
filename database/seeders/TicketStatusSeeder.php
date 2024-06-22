<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketStatus;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(TicketStatus::getAvailableValues() as $status)
            TicketStatus::create(
                [ 'status' => $status ]
            );
    }
}
