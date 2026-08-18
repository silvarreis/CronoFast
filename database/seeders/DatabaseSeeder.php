<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*Plan::create([
            'name' => 'Starter',
            'price' => 290.00,
            'description' => 'Cronometragem ilimitada + relatórios em PDF',
        ]);
        Plan::create([
            'name' => 'Business',
            'price' => 590.90,
            'description' => 'Tudo da Starter + Balanceamento de Células + Cálculo de Custo Minuto',
        ]);
        Plan::create([
            'name' => 'Enterprise',
            'price' => 1200.00,
            'description' => 'Tudo do Business + Dashboard de Produtividade + Suporte prioritário',
        ]);*/

    }
}
