<?php

namespace Database\Seeders;

use App\Models\Referent;
use Illuminate\Database\Seeder;

class ReferentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $models = [
            [
                'position'      => 'Presidente',
                'city'          => null,
                'name'          => 'Juan Martin Erro',
                'image_url'     => null,
                'whatsapp_link' => null,
            ],
            [
                'position'      => null,
                'city'          => 'Parana',
                'name'          => 'Adriel Budsisch',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/LUmi0AjZunL4sC9On0P2Am',
            ],
            [
                'position'      => null,
                'city'          => 'Concordia',
                'name'          => 'Mauricio Retamar',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/DmmPIcig2xbCwsxcxIIvmD',
            ],
            [
                'position'      => null,
                'city'          => 'Uruguay',
                'name'          => 'Alejandro Dus',
                'image_url'     => null,
                'whatsapp_link' => 'https://wa.me/qr/GYA2D2TZ4BQFO1',
            ],
            [
                'position'      => null,
                'city'          => 'Gualeguaychú',
                'name'          => 'Jazmín Maria Barboza',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/FWsthuJix3AErunLCyUTif',
            ],
            [
                'position'      => null,
                'city'          => 'Colón',
                'name'          => 'Gladys Ester Medina',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/IhRvNj4SPxILckeHIJdcoW',
            ],
            [
                'position'      => null,
                'city'          => 'Federal',
                'name'          => 'Sebastian Werner',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/FALxK7zG06ICIMS55KKG36',
            ],
            [
                'position'      => null,
                'city'          => 'Villaguay',
                'name'          => 'Alejandro López',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/HzpytEea1UEJ8rmhS62rOz',
            ],
            [
                'position'      => null,
                'city'          => 'Gualeguay',
                'name'          => 'Cristian Etulain',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/Ln8C0ZwOZNo1h431znWLzJ',
            ],
            [
                'position'      => null,
                'city'          => 'Diamante',
                'name'          => 'María Carolina Kranewitter',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/LdhTXe0C4SEHszuK7gnzDj',
            ],
            [
                'position'      => null,
                'city'          => 'Federación',
                'name'          => 'Mauricio Stivanello',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/DxKdZGh2tR8IC0vfKTscHq',
            ],
            [
                'position'      => null,
                'city'          => 'La Paz',
                'name'          => 'Jorge Fabián Roa Paibaz',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/JIY5C7JFEeVBupspctgBvG',
            ],
            [
                'position'      => null,
                'city'          => 'Rosario del Tala',
                'name'          => 'Glen Ignouville',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/FppsQLwP1vx6cMFaTTDheW',
            ],
            [
                'position'      => null,
                'city'          => 'Feliciano',
                'name'          => 'Jorge Miño',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/JbCKdXZ7w12Fqkq4sgAwoj',
            ],
            [
                'position'      => null,
                'city'          => 'Nogoya',
                'name'          => 'Alejandro López y Glen Ignouville',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/Ku3SllUBPHP6pKYTAbxcCc',
            ],
            [
                'position'      => null,
                'city'          => 'Ibicuy',
                'name'          => '',
                'image_url'     => null,
                'whatsapp_link' => 'https://chat.whatsapp.com/IFmewkB7RVH52fzeZNdgYi',
            ],
            [
                'position'      => null,
                'city'          => 'Victoria',
                'name'          => '',
                'image_url'     => null,
                'whatsapp_link' => 'https://wa.me/qr/MCURJFQVVANDA1',
            ],
        ];
        foreach ($models as $model) {
            Referent::create([
                'position'      => $model['position'],
                'city'          => $model['city'],
                'name'          => $model['name'],
                'image_url'     => $model['image_url'],
                'whatsapp_link' => $model['whatsapp_link'],
            ]);   
        }
    }
}
