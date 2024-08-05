<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        DB::table('roles')->insert([
            'role_name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create an admin user
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '0564843996',
            'profile_pic' => null,
            'last_login' => now(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed days of the week
        $days = [
            ['name' => 'Monday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tuesday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wednesday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thursday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Friday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Saturday', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sunday', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('days')->insert($days);

        DB::table('avenue_day_status')->insert([
            'status_name' => 'avilable',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('booking_statuses')->insert([
            [
                'statues_name' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'not paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'not approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('advantages')->insert([
            [
                'name' => 'Free wi-fi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'Projector',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'A/C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charging plugs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'Whiteboards',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'Storage',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'Shared table',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'statues_name' => 'Single table',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}


