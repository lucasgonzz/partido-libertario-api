<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
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
                'name'  => 'Gualeguay',
            ],
            [
                'name'  => 'Victoria',
            ],
            [
                'name'  => 'Parana',
            ],
        ];
        foreach ($models as $model) {
            Departament::create($model);
        }
    }
}
