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
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            ///DATA//////
            $table->text('image_path')->nullable();

            /////TIMESTAMPS+SOFTDELETE/////
            $table->timestamps();     
            $table->softDeletes();

        });

        Schema::table('employees', function (Blueprint $table) {
            
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
        });

        Schema::table('users', function (Blueprint $table) {
           
            $table->foreign('image_id')->references('id')->on('images')->onDelete('set null');
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
