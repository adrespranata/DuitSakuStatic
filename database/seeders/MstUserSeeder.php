<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = Str::uuid();
        User::create([
            'id' => $userId, // Menggunakan UUID sebagai primary key
            'email' => 'superadmin@example.com',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Mengisi detail user
        UserDetails::create([
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
