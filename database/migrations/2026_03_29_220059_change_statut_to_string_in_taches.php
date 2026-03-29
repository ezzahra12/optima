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
    Schema::table('taches', function (Blueprint $table) {
        // هاد السطر كيغير النوع لـ string بلا ما يتمسح العمود ولا تضيع البيانات
        $table->string('statut')->default('en attente')->change();
    });
}

public function down(): void
{
    Schema::table('taches', function (Blueprint $table) {
        $table->string('statut')->change();
    });
}
};
