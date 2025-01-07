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
        // Membuat tabel untuk kelas (course)
        Schema::create('tn_classroom', function (Blueprint $table) {
            $table->id(); // Kunci utama (primary key)
            $table->string('name'); // Nama kelas
            $table->string('code')->unique(); // Code kelas
            $table->text('description')->nullable(); // Deskripsi kelas
            $table->foreignId('creator_id')->constrained('users'); // Relasi ke pengguna (user) yang membuat kelas
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });

        // Membuat tabel untuk tugas (assignment)
        Schema::create('tn_assignments', function (Blueprint $table) {
            $table->id(); // Kunci utama (primary key)
            $table->string('title'); // Judul tugas
            $table->string('category')->nullable(); // Kategori tugas
            $table->boolean('is_group')->default(false); //Apakah tugas merupakan tugas kelompok atau tidak
            $table->text('description')->nullable(); // Deskripsi tugas
            $table->foreignId('class_room_id')->constrained('tn_classroom')->onDelete('cascade'); // Relasi ke kelas (course)
            $table->timestamp('due_date')->nullable(); // Tanggal batas waktu tugas
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });

        // Membuat tabel untuk catatan tugas (task records) yang dikerjakan oleh pengguna
        Schema::create('tn_task_records', function (Blueprint $table) {
            $table->id(); // Kunci utama (primary key)
            $table->foreignId('assignment_id')->constrained('tn_assignments')->onDelete('cascade'); // Relasi ke tugas (assignment)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke pengguna (user) yang mengerjakan tugas
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending'); // Status penyelesaian tugas
            $table->timestamp('completed_at')->nullable(); // Waktu penyelesaian tugas
            $table->text('notes')->nullable(); // Catatan tambahan dari pengguna
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });

        // Membuat tabel pivot untuk hubungan many-to-many antara pengguna (users) dan kelas (classes)
        Schema::create('user_classrooms', function (Blueprint $table) {
            $table->id(); // Kunci utama (primary key)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke pengguna (user)
            $table->foreignId('class_room_id')->constrained('tn_classroom')->onDelete('cascade'); // Relasi ke kelas (course)
            $table->timestamps(); // Waktu pembuatan dan pembaruan
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tn_classroom');
        Schema::dropIfExists('tn_assigments');
        Schema::dropIfExists('tn_task_records');
        Schema::dropIfExists('user_classrooms');
    }
};
