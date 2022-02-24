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
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

            $table->string('company_token', 192)->nullable();

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
            $table->timestamps();
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
