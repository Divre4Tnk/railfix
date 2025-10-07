<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin IT',
            'username' => 'admin',
            'email_verified_at' => now(),
            'password' => 'AdwinTnk4@7890',
        ]);

        $this->call([
            InventorySeeder::class,
            LocationSeeder::class,
        ]);

        Inventory::factory(50)->recycle([
            Location::all()
        ])->create();
    }
}
