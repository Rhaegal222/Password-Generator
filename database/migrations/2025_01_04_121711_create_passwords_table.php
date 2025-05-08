<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordsTable extends Migration
{
    public function up(): void
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nome per identificare la password (es. "Account Gmail")
            $table->string('password');  // La password generata
            $table->timestamps();  // Campi created_at e updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
}

