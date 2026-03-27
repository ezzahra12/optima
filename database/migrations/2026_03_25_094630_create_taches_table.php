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
        Schema::create('taches', function (Blueprint $table) {
          $table->id();
        $table->string('titre');
        $table->text('description')->nullable();
        $table->date('date_limite');
        $table->enum('statut', ['a_faire', 'en_cours', 'termine'])->default('a_faire');

        // Relation avec le Projet (Clé étrangère)
        $table->foreignId('projet_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
