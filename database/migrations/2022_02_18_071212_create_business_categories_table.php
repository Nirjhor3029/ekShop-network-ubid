<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en', 192)->nullable();
            $table->string('name_bn', 192)->nullable();
            $table->string('description', 192)->nullable();
            $table->unsignedInteger('bn_status')->nullable();
            $table->unsignedInteger('dbid_business_category_id')->nullable();
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
        Schema::dropIfExists('business_categories');
    }
}