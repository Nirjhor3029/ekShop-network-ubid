<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en', 192)->nullable();
            $table->string('name_bn', 192)->nullable();
            $table->string('address_en', 192)->nullable();
            $table->string('address_bn', 192)->nullable();
            $table->string('phone_no', 192)->nullable();
            $table->string('mobile_no', 192)->nullable();
            $table->string('email', 192)->nullable();
            $table->string('owner_phone_no', 192)->nullable();
            $table->string('owner_mobile_no', 192)->nullable();
            $table->string('owner_email', 192)->nullable();
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
}
