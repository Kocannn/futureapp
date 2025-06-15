<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c')->nullable();
            $table->string('pilihan_d')->nullable();
            $table->string('pilihan_e')->nullable();
            $table->string('jawaban_benar', 1);
            $table->text('pembahasan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
