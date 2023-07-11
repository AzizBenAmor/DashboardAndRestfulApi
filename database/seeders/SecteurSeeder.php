<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('secteurs')->insert([
            'nom'=>'Santé',
        ]);
        DB::table('secteurs')->insert(
        [
            'nom'=>'Développement'
        ],);
        DB::table('secteurs')->insert(
        [
            'nom'=>'juridique'  
        ]);
       
   
    

    }
}
