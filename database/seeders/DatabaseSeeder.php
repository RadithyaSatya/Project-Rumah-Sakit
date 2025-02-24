<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Dokter;
use App\Models\Ruangan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Muhammad Radithya Satya Gantara',
            'email' => 'radithyasatya7@gmail.com',
            'alamat'=>'Gang 7 laa',
            'password'=> Hash::make("password")
        ]);


        Ruangan::factory()->count(10)->create();

        Dokter::factory()->count(10)->create();
    }
}
