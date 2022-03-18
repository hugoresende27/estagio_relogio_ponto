<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clockpointentries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');

            $table->unsignedBigInteger('employee_id')->nullable()->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');

            // $table->timestamps('clock_in','clock_out');
            $table->timestamp ('clock_in')->nullable();
            $table->timestamp ('clock_out')->nullable();

            $table->nullableTimestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clockpointentries');
    }
};
