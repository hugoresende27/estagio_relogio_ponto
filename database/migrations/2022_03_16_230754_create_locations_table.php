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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            ///TENANT ID///////
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');

            /////DATA /////////////
            $table->text('country');
            $table->text('city');
            $table->text('street');
            $table->text('door_number');
            $table->text('zip_code');

      
            /////TIMESTAMPS+SOFTDELETE/////
            $table->timestamps();
            $table->softDeletes();
            
        });

        Schema::table('companies', function (Blueprint $table) {
            
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });

        Schema::table('employees', function (Blueprint $table) {
            
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
