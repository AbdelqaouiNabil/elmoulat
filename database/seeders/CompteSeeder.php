<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comptes')->insert([
            'bank_id' => 1,
            'numero' => 12345488,
            'date_creation' => "2016-05-10",
            'sold' => 50000,
           
            
        ]);
    }
}
