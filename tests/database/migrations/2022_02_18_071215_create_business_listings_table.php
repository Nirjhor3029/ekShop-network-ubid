<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_categories_id');
            $table->unsignedInteger('business_types_id');
            $table->unsignedInteger('companies_id');
            $table->unsignedInteger('applicant_type')->nullable();
            $table->string('applicant_name_en', 192)->nullable();
            $table->string('applicant_name_bn', 192)->nullable();
            $table->string('mobile', 192)->nullable();
            $table->string('applicant_father_name', 192)->nullable();
            $table->string('applicant_mother_name', 192)->nullable();
            $table->string('permanent_address', 192)->nullable();
            $table->string('present_address', 192)->nullable();
            $table->string('nid', 192)->nullable();
            $table->date('date_of_birthday')->nullable();
            $table->string('applier_designation', 192)->nullable();
            $table->string('business_name_en', 192)->nullable();
            $table->string('business_name_bn', 192)->nullable();
            $table->date('business_year')->nullable();
            $table->string('business_address_en', 192)->nullable();
            $table->string('business_address_bn', 192)->nullable();
            $table->string('business_phone', 192)->nullable();
            $table->string('business_mobile', 192)->nullable();
            $table->string('business_email', 192)->nullable();
            $table->string('business_web_url', 192)->nullable();
            $table->string('facebook_url', 192)->nullable();
            $table->string('business_office_type', 192)->nullable();
            $table->string('business_owner_name', 192)->nullable();
            $table->string('business_flat_no', 192)->nullable();
            $table->string('business_house_no', 192)->nullable();
            $table->string('business_road_no', 192)->nullable();
            $table->string('business_thana', 192)->nullable();
            $table->string('business_ward', 192)->nullable();
            $table->string('business_district', 192)->nullable();
            $table->string('business_owner_phone', 192)->nullable();
            $table->string('business_owner_mobile', 192)->nullable();
            $table->string('business_owner_email', 192)->nullable();
            $table->string('business_land_owner_nid', 192)->nullable();
            $table->string('business_trade_license_no', 192)->nullable();
            $table->string('business_trade_license_issuing_office', 192)->nullable();
            $table->date('business_last_renewal_date')->nullable();
            $table->unsignedInteger('business_registration_no')->nullable();
            $table->string('business_contact__person_name_en', 192)->nullable();
            $table->string('business_contact_person_address', 192)->nullable();
            $table->string('business_contact_person_mobile', 192)->nullable();
            $table->string('business_contact_person_email', 192)->nullable();
            $table->unsignedInteger('business_ubid_business_type')->nullable();
            $table->string('business_form_designation', 192)->nullable();
            $table->string('business_owner1_designation', 192)->nullable();
            $table->string('business_owner1_name', 192)->nullable();
            $table->string('business_owner1_nid', 192)->nullable();
            $table->string('business_owner1_address', 192)->nullable();
            $table->string('business_owner1_mobile', 192)->nullable();
            $table->string('business_owner1_email', 192)->nullable();
            $table->string('business_owner2_designation', 192)->nullable();
            $table->string('business_owner2_name', 192)->nullable();
            $table->string('business_owner2_nid', 192)->nullable();
            $table->string('business_owner2_address', 192)->nullable();
            $table->string('business_owner2_mobile', 192)->nullable();
            $table->string('business_owner2_email', 192)->nullable();
            $table->string('business_owner3_designation', 192)->nullable();
            $table->string('business_owner3_nid', 192)->nullable();
            $table->string('business_owner3_address', 192)->nullable();
            $table->string('business_owner3_mobile', 192)->nullable();
            $table->string('business_owner3_email', 192)->nullable();
            $table->string('business_bin_no', 192)->nullable();
            $table->string('business_tin_no', 192)->nullable();
            
            $table->foreign('companies_id', 'business_listings_ibfk_1')->references('id')->on('companies')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('business_types_id', 'business_listings_ibfk_2')->references('id')->on('business_types')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('business_categories_id', 'business_listings_ibfk_3')->references('id')->on('business_categories')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_listings');
    }
}
