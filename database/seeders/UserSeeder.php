<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            "fullname" => "Tống Nguyên Thắng",
            "username" => "nguyenthang",
            "email" => "nguyenthang6505@gmail.com",
            "password" => Hash::make("1"), 
            "image" => "profile/profile.jpg",
            "phone" => "0328238116",
            "gender" => "M",
            "address" => "Quyết Tiến Tiên Phương",
            "role_id" => 1,
            "remember_token" => Str::random(30),
            "created_at" => "2025-10-08 16:44:46",
            "updated_at" => "2025-10-08 16:44:46",
        ]);

        User::create([
            "fullname" => "Park Eun Bin",
            "username" => "Park Eun Bin",
            "email" => "ha@gmail.com",
            "password" => Hash::make("1"),
            "image" => "profile/Unknown.jpg",
            "phone" => "057368594",
            "gender" => "M",
            "address" => "Hợp Đồng Chương Mỹ",
            "role_id" => 2,
            "remember_token" => Str::random(30),
            "created_at" => "2025-10-08 16:51:13",
            "updated_at" => "2025-10-09 15:03:33",
        ]);

        User::create([
            "fullname" => "Tống Quốc Việt",
            "username" => "Shin Eun Soo",
            "email" => "quocvietp171@gmail.com",
            "password" => Hash::make("1"),
            "image" => "profile/profile.jpg",
            "phone" => "0971814725",
            "gender" => "M",
            "address" => "Quyết Tiến Tiên Phương CHương Mỹ Hà Nội",
            "role_id" => 2,
            "remember_token" => Str::random(30),
            "created_at" => "2025-10-17 07:24:06",
            "updated_at" => "2025-10-17 07:24:06",
        ]);
    }
}
