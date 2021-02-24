<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            [ 'title' => 'Manager',],
            [ 'title' => 'Employee',],

        ];

        foreach ($items as $item) {
            Role::create($item);
        }
    }
}
