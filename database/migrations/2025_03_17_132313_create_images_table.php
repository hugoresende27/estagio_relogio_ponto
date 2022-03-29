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
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            ///TENANT ID///////
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');

            ////FOREIGN IDS//////////////
            $table->unsignedBigInteger('employee_id')->nullable()->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            ///DATA//////
            $table->string('name');
            $table->text('image_path')->nullable();        
            $table->string('size');

            /////TIMESTAMPS+SOFTDELETE/////
            $table->timestamps();     
            $table->softDeletes();

        });

        Schema::table('employees', function (Blueprint $table) {
            
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
           
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
