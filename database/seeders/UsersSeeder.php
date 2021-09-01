<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    const USER_TYPES = [
        1 => "client",
        2 => "admin"
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->truncate();
        for ($i = 0; $i < 5; $i++) {
            DB::table("users")->insert([
                "name" => Str::random("10"),
                "email" => Str::random(5) . "99@example.com",
                "password" => Hash::make("Test@123"),
                "type" => $this->getRandomUserType(),
                "created_at" => Carbon::now()
            ]);
        }
    }

    /**
     * @return string
     */
    public function getRandomUserType(): string {
        return self::USER_TYPES[rand(1, count(self::USER_TYPES))];
    }
}
