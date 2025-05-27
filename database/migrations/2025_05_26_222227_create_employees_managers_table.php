<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesManagersTable extends Migration
{
    public function up()
    {
        Schema::create('employees_managers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->foreignId('manager_id')->constrained('employees')->onDelete('cascade');

            $table->timestamps();

            // Optional: لتجنب التكرار
            $table->unique(['employee_id', 'manager_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees_managers');
    }
}
