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
        Schema::create('transactions', function (Blueprint $table) {
           $table->id();
        $table->foreignId('produit_id')->constrained();
        $table->foreignId('comptable_id')->constrained('users'); // Qui a validé
        $table->enum('type', ['achat', 'vente']);
        $table->integer('quantite');
        $table->decimal('montant_total', 12, 2);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
