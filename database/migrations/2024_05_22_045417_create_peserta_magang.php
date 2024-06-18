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
        Schema::create('peserta_magang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->bigInteger('pembimbing_id')->unsigned()->nullable();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('instansi');
            $table->text('alamat');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('nilai')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('di_terima')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pembimbing_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_magang');
    }
};
