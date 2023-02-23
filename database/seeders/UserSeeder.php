<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = User::create([
            'name' => Str::random(10),
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password'),
           
        ]);
      
        $admin = User::create([
            'name' => Str::random(10),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            
        ]);
      
        $comptable = User::create([
            'name' => Str::random(10),
            'email' => 'comptable@gmail.com',
            'password' => Hash::make('password'),
           
        ]);
       
 
        
    }
}
