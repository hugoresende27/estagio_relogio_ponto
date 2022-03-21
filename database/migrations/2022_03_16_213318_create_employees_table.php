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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

             ///TENANT ID///////
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            
            ////FOREIGN IDS//////////////
            $table->unsignedBigInteger('company_id')->nullable()->index();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->unsignedBigInteger('department_id')->nullable()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');  
            $table->unsignedBigInteger('schedule_id')->nullable()->index();
            $table->unsignedBigInteger('location_id')->nullable()->index();     
            $table->unsignedBigInteger('image_id')->nullable()->index(); 
            
            /////DATA /////////////
            $table->text('name');
            $table->text('email')->nullable();        
            $table->text('role')->nullable();
            $table->text('nif')->nullable();
            $table->text('niss')->nullable();
            $table->text('iban')->nullable();
            $table->text('details')->nullable();
            $table->text('emer_contact')->nullable();
            $table->text('bi_cc')->nullable();
            $table->date('start_date')->nullable();


            /////BLIND INDEX////////////
            $table->string('name_bi');
        
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
        Schema::dropIfExists('employees');
    }
};
