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
        Schema::create('history_lelangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_lelang')->constrained('lelangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('id_user')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('id_barang')->constrained('barangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('penawaran_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_lelangs');
    }
};
