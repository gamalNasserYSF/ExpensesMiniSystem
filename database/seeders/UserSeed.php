<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
                [
                    'name' => 'Manager',
                    'email' => 'manager@system.com',
                    'password' => '$2y$10$msflsjAZ7jGwsJBZ18Uthu.C8DWDzxdRGhuwQpFUgreL4MPPxU0zq',
                    'role_id' => 1,
                    'isManager' => 1
                ],
                [
                    'name' => 'Employee',
                    'email' => 'employee@system.com',
                    'password' => '$2y$10$msflsjAZ7jGwsJBZ18Uthu.C8DWDzxdRGhuwQpFUgreL4MPPxU0zq',
                    'role_id' => 2,
                    'isManager' => 0
                ],
        ];

        foreach ($items as $item) {
            User::create($item);
        }
    }
}
