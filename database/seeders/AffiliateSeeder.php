<?php

namespace Database\Seeders;

use App\Models\Affiliate;
use Illuminate\Database\Seeder;

class AffiliateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) { 
            Affiliate::create([
                'name'          => 'Lucas '.$i,
                'dni'           => '42354898',
                'sex'           => 'Hombre',
                'birth_year'    => '2001',
                'birth_place'   => 'Gualeguay',
                'dni_address'   => 'Carmen Gadea 787',
                'dni_city'      => 'Gualeguay',
                'phone'         => '3444622139',
                'email'         => 'lucas@gmail.com',
            ]);
        }
    }
}
