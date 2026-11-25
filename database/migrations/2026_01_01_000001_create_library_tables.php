<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('title');
            $table->string('author');
            $table->year('publication_year');
            $table->unsignedInteger('pages');
            $table->string('isbn')->unique();
            $table->unsignedInteger('stock')->default(1);
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->timestamps();
        });

        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Anggota
            $table->foreignId('staff_id')->nullable()->constrained('users')->nullOnDelete(); // Petugas yang memproses
            $table->date('borrow_date');
            $table->date('due_date')->nullable();
            $table->date('return_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'return_pending', 'returned'])->default('pending');
            $table->timestamps();
        });

        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowing_id')->constrained('borrowings')->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
        });

        Schema::create('fines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Anggota
            $table->foreignId('borrowing_id')->nullable()->constrained('borrowings')->nullOnDelete(); // Transaksi terkait
            $table->foreignId('staff_id')->nullable()->constrained('users')->nullOnDelete(); // Petugas pemberi denda
            $table->json('violations'); // Array daftar pelanggaran, misal: ["Merusak Buku", "Terlambat Mengembalikan"]
            $table->unsignedBigInteger('total_amount');
            $table->enum('status', ['unpaid', 'paid'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fines');
        Schema::dropIfExists('borrowing_details');
        Schema::dropIfExists('borrowings');
        Schema::dropIfExists('books');
        Schema::dropIfExists('categories');
    }
};