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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users'); // User yang melakukan aktivitas
            $table->enum('action', ['create', 'update', 'delete']); // Aksi (contoh: "create", "update", "delete")
            $table->string('model'); // Model yang diubah (contoh: "TransactionRecord")
            $table->json('data')->nullable(); // Data lama atau baru
            $table->string('description')->nullable()->default(null); // description yang akan di tampilkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
