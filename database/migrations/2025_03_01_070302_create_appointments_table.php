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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->comment('Kode Janji');
            $table->string('first_name')->nullable()->comment('Nama depan');
            $table->string('last_name')->nullable()->comment('Nama belakang');
            $table->string('full_name')->nullable()->comment('Nama lengkap');
            $table->string('birth_place')->nullable()->comment('Tempat lahir');
            $table->date('birth_date')->nullable()->comment('Tanggal lahir');
            $table->tinyInteger('gender')->nullable()->comment('Jenis kelamin');
            $table->string('phone')->nullable()->comment('Nomor telepon');
            $table->string('address')->nullable()->comment('Alamat');
            $table->string('email')->nullable()->comment('Email');
            $table->string('appoint_for')->nullable()->comment('Janji untuk');
            $table->dateTime('appointment_date')->nullable()->comment('Tanggal janji');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
