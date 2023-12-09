<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                'name'              => "Admin",
                'email'             => "admin@spk.com",
                'role'              => User::ADMIN,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => "Theo",
                'email'             => "theo@spk.com",
                'role'              => User::ASSESSOR,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => "Steven",
                'email'             => "steven@spk.com",
                'role'              => User::ASSESSOR,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => "Lili",
                'email'             => "lili@spk.com",
                'role'              => User::ASSESSOR,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => "Ganjar",
                'email'             => "ganjar@spk.com",
                'role'              => User::ASSESSOR,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => "Andrian",
                'email'             => "andrian@spk.com",
                'role'              => User::ASSESSOR,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => "Erlan",
                'email'             => "erlan@spk.com",
                'role'              => User::ASSESSOR,
                'email_verified_at' => now(),
                'password'          => Hash::make("password"),
                'remember_token'    => Str::random(10),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}
