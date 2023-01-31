<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            'nom' => Str::random(10),
            'email' => Str::random(10),
            'phone' => 0666737207,
            'adress' => Str::random(10),
            'ville' => Str::random(10),
            
        ]);
    }
    }

