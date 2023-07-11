<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('professions')->insert([
            'nom'=>'Médecin',
            'secteur_id'=>1
        ], );
        DB::table('professions')->insert([
            'nom'=>'developpeur',
            'secteur_id'=>2
        ]);
        DB::table('professions')->insert([
        'nom'=>'Avocat',
        'secteur_id'=>3
    ]);
    }
}
