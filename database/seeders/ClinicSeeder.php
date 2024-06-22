<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Clinic;
use App\Models\City;
use Illuminate\Support\Facades\Hash;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clinic::create([
            'name' => 'Pro Gynecology',
            'city_id' => City::first()->id,
            'address' => 'Strada Revolutiei 3.',
            'description' => 'Small gynecology cabinet',
            'link' => 'https://www.google.com/maps/place/Cabinet+Ginecologic+Dr.+Gombor%C5%9F/@46.1728717,21.1787751,12z/data=!4m10!1m2!2m1!1sginecologie+arad!3m6!1s0x47459903c21a58dd:0x9ec22d30fa81fb37!8m2!3d46.1728717!4d21.3188508!15sChBnaW5lY29sb2dpZSBhcmFkWhIiEGdpbmVjb2xvZ2llIGFyYWSSARFneW5lY29sb2dpc3Rfb25seZoBJENoZERTVWhOTUc5blMwVkpRMEZuU1VSRU9VNUxlakYzUlJBQuABAA!16s%2Fg%2F1hc77k148?entry=ttu',
            'homepage' => 'https://ginecologie-arad.ro/'
        ]);
    }
}
