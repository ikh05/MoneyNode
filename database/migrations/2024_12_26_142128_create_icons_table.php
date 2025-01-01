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
        // kategori: accounts, books, income, pengeluaran parties
        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama ikon
            $table->foreignId('uploader_id')->nullable()->constrained('users'); // Relasi ke pengguna sebagai orang yang mengapload
            $table->string('path'); // Lokasi file ikon
            $table->boolean('isGlobel')->default(FALSE); // apakah bisa dilihat orang lain
            $table->json('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icons');
    }
};
