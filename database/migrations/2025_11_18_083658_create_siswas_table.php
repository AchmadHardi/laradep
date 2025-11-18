<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lembaga_id');
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('lembaga_id')
                  ->references('id')
                  ->on('lembagas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
