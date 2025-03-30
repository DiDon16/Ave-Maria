<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mrc_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Patient::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->decimal('creatinine_level', 8, 2); // Niveau de créatinine
            $table->decimal('gfr', 8, 2); // Taux de filtration glomérulaire (GFR)
            $table->decimal('albumin_level', 8, 2)->nullable(); // Niveau d'albumine
            $table->string('stage')->nullable(); // Stade de la MRC (prédit par l'IA)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrc_analyses');
    }
};
