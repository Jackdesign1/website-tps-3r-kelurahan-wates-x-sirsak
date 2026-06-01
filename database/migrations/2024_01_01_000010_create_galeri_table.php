<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('url_foto');
            $table->date('tanggal');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('galeri'); }
};
