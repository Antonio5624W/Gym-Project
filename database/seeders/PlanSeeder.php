<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Plan::create([
            'name' => 'Vdisita Diaria',
            'duration_days' => 1,
            'price' => 50.00
        ]);

        \App\Models\Plan::create([
            'name' => 'Mensualidad',
            'duration_days' => 30,
            'price' => 500.00
        ]);

        \App\Models\Plan::create([
            'name' => 'Anualidad VIP',
            'duration_days' => 365,
            'price' => 4500.00
        ]);
    }
}
