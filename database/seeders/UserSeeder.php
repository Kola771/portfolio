<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUsers = [
            [
                'name' => 'Koladé ABOUDOU M.',
                'email' => 'koladeaboudou@gmail.com',
                'password' => bcrypt('asdepic001'),
                'email_verified_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Koladé ABOUDOU M.',
                'email' => 'asdepic771@gmail.com',
                'password' => bcrypt('asdepic771'),
                'email_verified_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ];

        foreach ($adminUsers as $adminUserData) {
            User::create($adminUserData);
        }
    }
}
