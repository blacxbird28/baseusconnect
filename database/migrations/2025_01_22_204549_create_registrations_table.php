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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_ktp');
            $table->string('domisili');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('size');
            $table->string('community_name');
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->text('partner_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
