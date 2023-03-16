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
        $this->call(RoleSeeder::class);

         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ])->assignRole('admin');

         \App\Models\User::factory()->create([
             'name' => 'SaloMerdas',
             'email' => 'salomerdas@example.com',
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ])->assignRole('jugador');

         \App\Models\User::factory()->create([
             'name' => 'AndyVAliste',
             'email' => 'andyvaliste@example.com',
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ])->assignRole('representante');

         \App\Models\User::factory()->create([
             'name' => 'JoelPro',
             'email' => 'joelpro@example.com',
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         ])->assignRole('representante');

        \App\Models\Sancion::create([
            'tipo' => 'roja'
         ]);
    
        \App\Models\Sancion::create([
            'tipo' => 'ninguna'
        ]);

        \App\Models\Sancion::create([
            'tipo' => 'amarilla'
        ]);

        
    }
}
