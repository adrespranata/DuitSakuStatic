<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'email' => 'superadmin@example.com',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('user_details')->insert([
            'user_id' => $userId,
            'first_name' => 'Adres',
            'middle_name' => '',
            'last_name' => 'Pranata',
            'picture' => 'profile.jpg',
            'address' => 'Jl. 2 jalur simpang, RW.4, Talang Saling, Kec. Seluma, Kabupaten Seluma, Bengkulu 38876, Indonesia',
            'city' => 'Bengkulu',
            'country' => 'Indonesia',
            'postal_code' => '38876',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
