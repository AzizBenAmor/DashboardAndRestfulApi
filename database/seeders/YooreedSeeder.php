<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class YooreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('partenaires')->insert([
            'nom'=>'Yooreed',
            'nom_responsable'=>'Yooreed',
            'email'=>'Yooreed',
            'password'=>Hash::make('Yooreed'),
            'cin'=>'14725836',
            'numero'=>'Yooreed',
            'adress'=>'Avenue Colonel Bjaoui
            Immeuble Boulhalha 3 Eme
            Etage',
            'image'=>'1255.png',
            'gov_id'=>1,
            'ville_id'=>1,
            'secteur_id'=>2,
            'profession_id'=>2,
            'specialite_id'=>1,
        ], );
    }
}
