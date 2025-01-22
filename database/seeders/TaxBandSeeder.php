<?php

namespace Database\Seeders;

use App\Models\TaxBand;
use Illuminate\Database\Seeder;

class TaxBandSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifiez si la bande A existe déjà
        if (!TaxBand::where('lower_limit', 0)->where('upper_limit', 5000)->where('rate', 0)->exists()) {
            TaxBand::create([
                'name' => 'Band A',
                'lower_limit' => 0,
                'upper_limit' => 5000,
                'rate' => 0,
                'color' => '#22c55e' // Vert
            ]);
        }

        // Vérifiez si la bande B existe déjà
        if (!TaxBand::where('lower_limit', 5000)->where('upper_limit', 20000)->where('rate', 20)->exists()) {
            TaxBand::create([
                'name' => 'Band B',
                'lower_limit' => 5000,
                'upper_limit' => 20000,
                'rate' => 20,
                'color' => '#f97316' // Orange
            ]);
        }

        // Vérifiez si la bande C existe déjà
        if (!TaxBand::where('lower_limit', 20000)->where('upper_limit', null)->where('rate', 40)->exists()) {
            TaxBand::create([
                'name' => 'Band C',
                'lower_limit' => 20000,
                'upper_limit' => null,
                'rate' => 40,
                'color' => '#ef4444' // Rouge
            ]);
        }
    }
} 