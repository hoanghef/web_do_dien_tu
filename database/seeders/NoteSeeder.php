<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NoteSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::create([
            "order_notes" => "Chờ xác nhận"
        ]);

        Note::create([
            "order_notes" => "Đã xác nhận"
        ]);
    }
}
