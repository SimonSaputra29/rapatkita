<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade'); // Pembuat undangan
            $table->date('date'); // Tanggal rapat
            $table->time('time'); // Waktu rapat
            $table->string('location'); // Tempat rapat
            $table->text('topic'); // Topik atau agenda rapat
            $table->text('participants'); // Daftar peserta rapat
            $table->string('attachment')->nullable(); // Lampiran file tambahan
            $table->text('note')->nullable(); // Catatan tambahan
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected']);
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null'); // Siapa yang menyetujui (atasan)
            $table->timestamp('approved_at')->nullable(); // Waktu disetujui/ditolak
            $table->timestamps(); // created_at, updated_at
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
