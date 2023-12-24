<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Truck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'haikal@gmail.com',
            'password' =>  Hash::make('12345678'),
        ]);

        \App\Models\Setting::factory()->create();

        Truck::factory()->count(1000)->create();
        Customer::factory()->count(1000)->create();
    }
}
