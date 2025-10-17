<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        CategorySeeder::class,
        ProductSeeder::class,
    ]);
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            BankSeeder::class,
            ProductSeeder::class,
            NoteSeeder::class,
            PaymentSeeder::class,
            StatusSeeder::class,
            CategorySeeder::class,
            TransactionSeeder::class,
            OrderSeeder::class
        ]);
    }
}
