<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SecteurSeeder::class);
        $this->call(ProfessionSeeder::class);
        $this->call(SpecialitySeeder::class);
        $this->call(CauseSeedee::class);
        $this->call(GovSeeder::class);
        $this->call(VilleSeeder::class);
        $this->call(YooreedSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
