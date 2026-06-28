<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tinyurls', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('slug')->unique();
            $table->string('redirect')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tinyurls');
    }
};
