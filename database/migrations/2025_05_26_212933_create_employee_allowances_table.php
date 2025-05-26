<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employee_allowances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('type'); 
            $table->decimal('amount', 10, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable(); // يعني مستمر إذا كان null
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_allowances');
    }
};
