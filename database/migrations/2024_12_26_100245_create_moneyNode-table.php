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
        Schema::create('mn_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Relasi ke pengguna
            $table->foreignId('icon_id')->constrained('icons'); // Icon 
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('mn_accounts', function (Blueprint $table) {
            // kategori uang cash, virtual, hutang, piutang
            $table->id();
            $table->foreignId('book_id')->constrained('mn_books')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('first_nominal', 15, 2);
            $table->string('currency', 3)->default('IDR');
            $table->foreignId('icon_id')->nullable()->constrained('icons')->cascadeOnDelete();
            $table->boolean('is_asset')->default(true);
            $table->string('description')->nullable(); //untuk memberi keterangan bahwa peruntukan akun untuk apa
            $table->enum('type', ['cash', 'virtual', 'hutang', 'piutang'])->nullable();
            $table->timestamps();
        });

        // type : pengeluaran atau pemasukkan
        Schema::create('mn_transaction_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('book_id')->constrained('mn_books'); // Relasi ke buku
            $table->foreignId('icon_id')->nullable()->constrained('icons'); // Ikon untuk kategori
            $table->enum('type', ['income', 'expense'])->nullable(); // Pemasukan atau pengeluaran
            $table->timestamps();
        });
        
        Schema::create('mn_transaction_parties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('mn_books'); // Relasi ke buku
            $table->foreignId('icon_id')->nullable()->constrained('icons'); // Ikon untuk kategori
            $table->string('name'); // Nama pihak (contoh: "Orang Tua", "Teman")
            $table->enum('type', ['income', 'expense'])->nullable(); // Pemasukan atau pengeluaran
            $table->timestamps();
        });

        Schema::create('mn_transaction_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->nullable()->constrained('mn_accounts');
            $table->foreignId('party_id')->nullable()->constrained('mn_transaction_parties');
            $table->foreignId('category_id')->nullable()->constrained('mn_transaction_categories');
            $table->foreignId('to_account_id')->nullable()->constrained('mn_accounts'); 
            $table->foreignId('from_account_id')->nullable()->constrained('mn_accounts'); 
            $table->foreignId('book_id')->constrained('mn_books'); 
            $table->enum('type', ['income', 'expense', 'transfer']); 
            $table->decimal('nominal', 15, 2); 
            $table->text('description')->nullable(); 
            $table->date('date'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mn_books');
        Schema::dropIfExists('mn_accounts');
        Schema::dropIfExists('mn_transaction_records');
        Schema::dropIfExists('mn_transaction_categories');
        Schema::dropIfExists('mn_transaction_parties');
    }
};
