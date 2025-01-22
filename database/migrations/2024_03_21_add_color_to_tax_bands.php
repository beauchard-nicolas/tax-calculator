<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tax_bands', function (Blueprint $table) {
            $table->string('color')->default('#22c55e'); // Vert par défaut
        });

        // Mettre à jour les couleurs avec les bonnes valeurs
        DB::table('tax_bands')->where('name', 'Band A')->update(['color' => '#22c55e']); // Vert
        DB::table('tax_bands')->where('name', 'Band B')->update(['color' => '#f97316']); // Orange
        DB::table('tax_bands')->where('name', 'Band C')->update(['color' => '#ef4444']); // Rouge
    }

    public function down(): void
    {
        Schema::table('tax_bands', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}; 