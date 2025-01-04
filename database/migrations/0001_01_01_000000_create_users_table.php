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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('no_wa')->unique()->nullable();
            $table->timestamp('no_wa_verified_at')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(False);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // kategori: accounts, books, income, pengeluaran parties
        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama ikon
            $table->foreignId('uploader_id')->nullable()->constrained('users'); // Relasi ke pengguna sebagai orang yang mengapload
            $table->string('path'); // Lokasi file ikon
            $table->boolean('is_globel')->default(FALSE); // apakah bisa dilihat orang lain
            $table->json('type')->nullable();
            $table->timestamps();
        });
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('icons');
        Schema::dropIfExists('logs');
    }
};
