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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            ///TENANT ID///////
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');

            ////FOREIGN IDS//////////////
            $table->unsignedBigInteger('location_id')->nullable()->index();
            $table->unsignedBigInteger('file_id')->nullable()->index();
            $table->foreign('file_id')->references('id')->on('files')->onDelete('set null');
            
            ///DATA//////
            $table->text('name');
            $table->text('email');
            $table->text('nif');
            
            /////TIMESTAMPS+SOFTDELETE/////
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
        Schema::dropIfExists('companies');
    }
};
