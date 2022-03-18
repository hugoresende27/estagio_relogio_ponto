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
            $table->unsignedBigInteger('tenant_id')->nullable()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');

            $table->text('country');
            $table->text('city');
            $table->text('street');
            $table->text('zip_code');

            // $table->unsignedBigInteger('company_id')->nullable()->index();
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');

            // $table->unsignedBigInteger('department_id')->nullable()->index();
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

            $table->timestamps();

            $table->softDeletes();
            
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable()->index();
            $table->foreign('location_id')->references('id')->on('companies')->onDelete('set null');
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
