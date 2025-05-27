<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('hire_date');
            $table->date('birth_date')->nullable();
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->timestamps();
        });

        
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
