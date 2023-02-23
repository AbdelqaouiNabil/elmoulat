<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
            UserSeeder::class,
            DomaineSeeder::class,
            BankSeeder::class,
            CompteSeeder::class,
        ]);
        $this->call(LaratrustSeeder::class);
        $admin = User::where('email','admin@gmail.com')->first();
        $admin->attachRole('admin');
        $owner = User::where('email','owner@gmail.com')->first();
        $owner->attachRole('owner');

       
    }
}
