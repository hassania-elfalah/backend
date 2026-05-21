<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            // PostgreSQL: add new value to existing enum type
            DB::statement("ALTER TYPE images_chambre_type_media_check ADD VALUE IF NOT EXISTS 'panorama'");
        } else {
            Schema::table('images_chambre', function (Blueprint $table) {
                $table->enum('type_media', ['image', 'video', 'panorama'])->default('image')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            Schema::table('images_chambre', function (Blueprint $table) {
                $table->enum('type_media', ['image', 'video'])->default('image')->change();
            });
        }
    }
};
