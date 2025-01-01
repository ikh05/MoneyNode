<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpOption\None;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constrained('accounts');
            $table->foreignId('party_id')->nullable()->constrained('transaction_parties');
            $table->foreignId('category_id')->nullable()->constrained('transaction_categories');
            $table->foreignId('to_account_id')->nullable()->constrained('accounts'); 
            $table->foreignId('from_account_id')->nullable()->constrained('accounts'); 
            $table->foreignId('book_id')->constrained('books'); 
            $table->enum('type', ['income', 'expense', 'transfer']); 
            $table->decimal('nominal', 15, 2); 
            $table->text('description')->nullable(); 
            $table->date('date'); 
            $table->timestamps();
        });
        
        // type : pengeluaran atau pemasukkan
        Schema::create('transaction_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('book_id')->constrained('books'); // Relasi ke buku
            $table->foreignId('icon_id')->nullable()->constrained('icons'); // Ikon untuk kategori
            $table->enum('type', ['income', 'expense'])->nullable(); // Pemasukan atau pengeluaran
            $table->timestamps();
        });
        
        Schema::create('transaction_parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books'); // Relasi ke buku
            $table->foreignId('icon_id')->nullable()->constrained('icons'); // Ikon untuk kategori
            $table->string('name'); // Nama pihak (contoh: "Orang Tua", "Teman")
            $table->enum('type', ['income', 'expense'])->nullable(); // Pemasukan atau pengeluaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_records');
        Schema::dropIfExists('transaction_categories');
        Schema::dropIfExists('transaction_parties');
    }
};
