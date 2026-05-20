<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Initialize Faker. Boleh letak locale 'en_US' atau biarkan default.
        $faker = Factory::create('ms_MY');
        
        $data = [];

        // 2. Loop untuk generate 50 data dummy
        for ($i = 0; $i < 50; $i++) {
            $data[] = [
                'username'   => $faker->userName,
                'email'      => $faker->unique()->safeEmail,
                'password'   => password_hash('password123', PASSWORD_BCRYPT), // Default password
                'phone'      => $faker->phoneNumber,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        // 3. Insert masuk dalam table 'users' guna Query Builder
        // insertBatch() jauh lebih laju daripada insert() satu-satu dalam loop
        $this->db->table('users2')->insertBatch($data);
    }
}