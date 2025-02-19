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
        Schema::create('my__parents', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("password");
            
            // Father Info
            
            $table->string("father_name");
            $table->string("father_nation");
            $table->string("father_phone");
            $table->string("father_job");
            $table->string("father_addres");
            
            // Mother Info
            
            $table->string("mother_name");
            $table->string("mother_nation");
            $table->string("mother_phone");
            $table->string("mother_job");
            $table->string("mother_addres");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my__parents');
    }
};
