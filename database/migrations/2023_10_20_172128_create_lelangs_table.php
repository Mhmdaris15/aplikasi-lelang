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
        Schema::create('lelangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_barang')->constrained('barangs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('id_user')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('id_petugas')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('tanggal');
            $table->integer('harga_akhir');
            $table->enum('status', ['dibuka', 'ditutup']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelangs');
    }
};
