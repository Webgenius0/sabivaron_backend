<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void {
        DB::table('users')->insert([
            [
                'id'                => 1,
                'name'              => 'admin',
                'email'             => 'admin@admin.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'phone'             => '1234567890',
                'terms_and_policy'  => 1,
                'avatar'            => null,
                'google_id'         => null,
                'apple_id'          => null,
                'role'              => 'admin',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-09-05 04:06:22',
                'updated_at'        => '2024-09-05 10:07:59',
                'deleted_at'        => null,
            ],
            [
                'id'                => 2,
                'name'              => 'client',
                'email'             => 'client@client.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'phone'             => '1234567890',
                'terms_and_policy'  => 1,
                'avatar'            => null,
                'google_id'         => null,
                'apple_id'          => null,
                'role'              => 'client',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-09-05 04:07:08',
                'updated_at'        => '2024-09-05 10:07:37',
                'deleted_at'        => null,
            ],
            [
                'id'                => 3,
                'name'              => 'case',
                'email'             => 'case@case.com',
                'email_verified_at' => null,
                'password'          => Hash::make('12345678'),
                'phone'             => '1234567890',
                'terms_and_policy'  => 1,
                'avatar'            => null,
                'google_id'         => null,
                'apple_id'          => null,
                'role'              => 'case',
                'status'            => 'active',
                'remember_token'    => null,
                'created_at'        => '2024-09-05 04:07:08',
                'updated_at'        => '2024-09-05 10:07:37',
                'deleted_at'        => null,
            ],
        ]);
    }
}
