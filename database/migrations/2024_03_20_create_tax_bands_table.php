<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tax_bands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('lower_limit');
            $table->integer('upper_limit')->nullable();
            $table->integer('rate');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tax_bands');
    }
}; 