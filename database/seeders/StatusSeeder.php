<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            "order_status" => "Hoàn thành",
            "style" => "Thông tin",
        ]);
        Status::create([
            "order_status" => "Đang chờ",
            "style" => "Cảnh báo",
        ]);
        Status::create([
            "order_status" => "Đã duyệt",
            "style" => "Thành công",
        ]);
        Status::create([
            "order_status" => "Đã hủy",
            "style" => "Phụ",
        ]);
    }
}
