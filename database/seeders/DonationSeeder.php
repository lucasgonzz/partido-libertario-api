<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            Donation::create([
                'transaction_amount' => 500,
                'token' => 'asdq13213',
                'description' => 'Donacion al partido',
                'installments' => 1,
                'payment_method_id' => 'Visa',
                'issuer' => 1,
                'email' => 'lucas@gmail.com',
                'doc_type' => 'DNI',
                'doc_number' => '42354898',
                'status' => 'aproved',
            ]);
        }
    }
}
