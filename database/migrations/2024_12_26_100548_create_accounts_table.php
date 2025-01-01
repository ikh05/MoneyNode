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
        Schema::create('accounts', function (Blueprint $table) {
            // kategori uang cash, virtual, bank, hutang, piutang
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('first_nominal', 15, 2);
            $table->string('currency', 3)->default('IDR');
            $table->foreignId('icon_id')->nullable()->constrained('icons')->cascadeOnDelete();
            $table->enum('type', ['cash', 'virtual', 'hutang', 'piutang'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
