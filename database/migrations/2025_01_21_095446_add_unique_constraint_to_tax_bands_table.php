<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToTaxBandsTable extends Migration
{
    public function up()
    {
        Schema::table('tax_bands', function (Blueprint $table) {
            $table->unique(['lower_limit', 'upper_limit', 'rate']);
        });
    }

    public function down()
    {
        Schema::table('tax_bands', function (Blueprint $table) {
            $table->dropUnique(['lower_limit', 'upper_limit', 'rate']);
        });
    }
}