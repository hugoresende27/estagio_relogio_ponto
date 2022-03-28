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

             ///TENANT ID///////
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');

            ////FOREIGN IDS//////////////
            $table->unsignedBigInteger('employee_id')->nullable()->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('file_id')->nullable()->index();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
            
             ///DATA//////
            // $table->timestamp ('clock_in')->nullable();
            // $table->timestamp ('clock_out')->nullable();
            $table->datetime ('clock_in')->nullable();
            $table->datetime ('clock_out')->nullable();
            $table->time('clock_total')->nullable();


             /////NO// TIMESTAMPS+SOFTDELETE/////
            // $table->nullableTimestamps();
            $table->timestamps();   
            $table->softDeletes();
            
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
