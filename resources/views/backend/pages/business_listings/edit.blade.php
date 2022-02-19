@extends('backend.layouts.admin')
<?php
$themePath = asset('theme/');
?>
@section('title')
    Role Create - Admin Panel
@endsection
@section('styles')
    <style>
        .flex-end {
            display: flex;
            justify-content: end;
        }

    </style>
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit The Entry</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Business Listing </a></li>
                        <li class="breadcrumb-item active">Edit Entry</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('admin-content')
    <section class="content">
        <div class="container-fluid">

            <form action="{{ route('admin.business_listings.update', [$data->id]) }}" method="post">
                @csrf

                <!-- Main row -->
                <div class="row">

                    {{-- Applicants information --}}
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h3 class="card-title">Applicants information</h3>
                                    </div>
                                    <div class="col-sm-6">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- Row --}}
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Applicant Type</label>
                                        <select class="form-control" name="applicant_type" id="applicant_type">
                                            <option value="{{ 0 }}" selected>Type 0</option>
                                        </select>
                                    </div>
                                    <!-- checkbox -->
                                    <div class="col-sm-6 form-group clearfix checkbox-flex">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="applicantIsOwner" name="applicant_is_owner"
                                                value='true'>
                                            <label for="applicantIsOwner">
                                                Applicant & Owner same
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.input group -->
                                {{-- Row --}}

                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="applicant_name_en">Applicant Name Engish</label>
                                        <input type="text" class="form-control" id="applicant_name_en"
                                            name="applicant_name_en" placeholder="Enter Applicant Name in English"
                                            value="{{ $data->applicant_name_en }}">
                                    </div>
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="applicant_name_bn">Applicant Name Bangla</label>
                                        <input type="text" class="form-control" id="applicant_name_bn"
                                            name="applicant_name_bn" placeholder="Enter Applicant Name in English"
                                            value="{{ $data->applicant_name_bn }}">
                                    </div>
                                </div>
                                {{-- Father & Mother Name --}}
                                <div class="row">

                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="applicant_father_name">Applicant's Father Name</label>
                                        <input type="text" class="form-control" id="applicant_father_name"
                                            name="applicant_father_name" placeholder="Enter Applicant's Father Name"
                                            value="{{ $data->applicant_father_name }}">
                                    </div>


                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="applicant_mother_name">Applicant's Mother Name</label>
                                        <input type="text" class="form-control" id="applicant_mother_name"
                                            name="applicant_mother_name" placeholder="Enter Applicant's Mother Name"
                                            value="{{ $data->applicant_mother_name }}">
                                    </div>

                                </div>
                                {{-- Mobile & Email --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="mobile">Applicant's Mobile</label>
                                        <input type="phone" class="form-control" id="mobile" name="mobile"
                                            placeholder="Enter Applicant's Mobile" value="{{ $data->mobile }}">
                                    </div>
                                </div>
                                {{-- Address --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="permanent_address">Applicant's Permanent Address</label>
                                        <textarea class="form-control" id="permanent_address" name="permanent_address"
                                            placeholder="Enter Applicant's Permanent Address">{{ $data->permanent_address }}</textarea>
                                    </div>

                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="present_address">Applicant's Present Address</label>
                                        <textarea class="form-control" id="present_address" name="present_address"
                                            placeholder="Enter Applicant's Present Address">{{ $data->present_address }}</textarea>
                                    </div>
                                </div>
                                {{-- Info --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="nid">Applicant's National ID</label>
                                        <input type="text" class="form-control" id="nid" name="nid"
                                            placeholder="Enter Applicant's National ID" value="{{ $data->nid }}">
                                    </div>

                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="date_of_birthday">Applicant's Date Of Birth</label>
                                        <input type="date" class="form-control" id="date_of_birthday"
                                            name="date_of_birthday" placeholder="Enter Applicant's date Of Birth"
                                            value="{{ $data->date_of_birthday }}">
                                    </div>
                                </div>
                                {{-- Info --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group  ">
                                        <label for="applier_designation">Applier Designation</label>

                                        <select class="form-control" name="applier_designation" id="applier_designation">
                                            <option value="{{ 'owner' }}"
                                                {{ $data->applier_designation == 'owner' ? 'selected' : '' }}>Owner
                                            </option>
                                            <option value="{{ 'chairman' }}"
                                                {{ $data->applier_designation == 'owner' ? 'selected' : '' }}>Chairman
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                        </div>
                        <!-- /.card-body -->
                    </div>


                    {{-- Company's Information --}}
                    <div class="col-md-6">

                        {{-- Owners info --}}
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Owner's information</h3>
                            </div>
                            <div class="card-body jq_required" id="owners_info">

                                {{-- Owner's info --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="business_owner_name">Owner's Name Bangla</label>
                                        <input type="text" class="form-control" id="business_owner_name"
                                            name="business_owner_name" placeholder="Enter Owner's Name in Bangla"
                                            value="{{ $data->business_owner1_name }}">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="business_owner_email">Enter Business Owner Email</label>
                                        <input type="email" class="form-control" id="business_owner_email"
                                            name="business_owner_email" placeholder="Enter Business Owner Email"
                                            value="{{ $data->business_owner1_email }}">
                                    </div>
                                </div>
                                {{-- Owner Phone --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="business_owner_phone">Enter Business owner Phone</label>
                                        <input type="phone" class="form-control" id="business_owner_phone"
                                            name="business_owner_phone" placeholder="Enter Business owner Phone"
                                            value="{{ $data->business_owner1_mobile }}">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="business_owner_mobile">Enter Business owner Mobile</label>
                                        <input type="phone" class="form-control" id="business_owner_mobile"
                                            name="business_owner_mobile" placeholder="Enter Business owner Mobile"
                                            value="{{ $data->business_owner1_mobile }}">
                                    </div>
                                </div>
                                {{-- Owner NID --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="business_owner_nid">Enter Business owner NID</label>
                                        <input type="text" class="form-control" id="business_owner_nid"
                                            name="business_owner_nid" placeholder="Enter Business owner NID"
                                            value="{{ $data->business_owner1_nid }}">
                                    </div>

                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card card-primary jq_required">
                            <div class="card-header">
                                <h3 class="card-title">Company Info</h3>
                            </div>
                            <div class="card-body">
                                {{-- Owner's info --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="member_id">Enter Member ID (unique)</label>
                                        <input type="text" class="form-control" id="member_id" name="member_id"
                                            placeholder="Enter Member ID (unique)" value="{{ $data->member_id }}">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="companies_id">Company</label>
                                        <select class="form-control" name="companies_id" id="companies_id">
                                            @foreach ($companyInfo as $compamy)
                                                <option value="{{ $compamy->id }}"
                                                    {{ $data->companies->id == $compamy->id ? 'selected' : '' }}>
                                                    {{ $compamy->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="business_categories_id">Business Category</label>
                                        <select class="form-control" name="business_categories_id"
                                            id="business_categories_id">
                                            @foreach ($businessCategory as $business)
                                                <option value="{{ $business->dbid_business_type_id }}"
                                                    {{ $data->business_categories_id == $business->dbid_business_type_id ? 'selected' : '' }}>
                                                    {{ $business->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="business_types_id">Business Type</label>
                                        <select class="form-control" name="business_types_id" id="business_types_id">
                                            @foreach ($businessType as $business)
                                                <option value="{{ $business->dbid_business_type_id }}"
                                                    {{ $data->business_types_id == $business->dbid_business_type_id ? 'selected' : '' }}>
                                                    {{ $business->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col (right) -->
                    <!-- /.card -->
                </div>


                {{-- New Row --}}
                <div class="row">

                    {{-- Shop Information --}}
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Shop information</h3>
                            </div>
                            <div class="card-body">
                                {{-- Business Name --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="business_name_en">Enter Business Name In English</label>
                                        <input type="text" class="form-control" id="business_name_en"
                                            name="business_name_en" placeholder="Enter Business Name In English"
                                            value="{{ $data->business_name_en }}">
                                    </div>
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="business_name_bn">Enter Business Name In Bangla</label>
                                        <input type="text" class="form-control" id="business_name_bn"
                                            name="business_name_bn" placeholder="Enter Business Name In Bangla"
                                            value="{{ $data->business_name_bn }}">
                                    </div>
                                </div>
                                {{-- Year --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="business_year">Enter Business year</label>
                                        <input type="text" class="form-control" id="business_year" name="business_year"
                                            placeholder="Enter Business year" value="{{ $data->business_year }}">
                                    </div>
                                </div>
                                {{-- Business Address --}}
                                <div class="row">
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="business_address_en">Enter Business Address in English</label>
                                        <textarea class="form-control" id="business_address_en" name="business_address_en"
                                            placeholder="Enter Business Address in English">{{ $data->business_address_en }}</textarea>
                                    </div>
                                    <div class="col-sm-6 form-group jq_required">
                                        <label for="business_address_bn">Enter Business Address in Bangla</label>
                                        <textarea class="form-control" id="business_address_bn"
                                            name="business_address_bn"
                                            placeholder="Enter Business Address in Bangla">{{ $data->business_address_bn }}</textarea>
                                    </div>
                                </div>

                                {{-- Business Phone --}}
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="business_phone">Enter Business Phone</label>
                                        <input type="phone" class="form-control" id="business_phone"
                                            name="business_phone" placeholder="Enter Business Phone"
                                            value="{{ $data->business_phone }}">
                                    </div>
                                    <div class="col-sm-4 form-group jq_required">
                                        <label for="business_mobile">Enter Business mobile</label>
                                        <input type="phone" class="form-control" id="business_mobile"
                                            name="business_mobile" placeholder="Enter Business mobile"
                                            value="{{ $data->business_mobile }}">
                                    </div>
                                    <div class="col-sm-4 form-group jq_required">
                                        <label for="business_email">Enter Business Email</label>
                                        <input type="email" class="form-control" id="business_email"
                                            name="business_email" placeholder="Enter Business Email"
                                            value="{{ $data->business_email }}">
                                    </div>
                                </div>

                                {{-- Business URL --}}
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="business_web_url">Enter Business Web URL</label>
                                        <input type="url" class="form-control" id="business_web_url"
                                            name="business_web_url" placeholder="Enter Business Web URL"
                                            value="{{ $data->business_web_url }}">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="facebook_url">Enter Business Facebook URL</label>
                                        <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                                            placeholder="Enter Business Facebook URL" value="{{ $data->facebook_url }}">
                                    </div>
                                    {{-- <div class="col-sm-4 form-group">
                                        <label for="business_office_type">Enter Business Email</label>
                                        <select class="form-control" name="business_office_type"
                                            id="business_office_type">
                                            <option value="{{ 'rent' }}" selected>Rent</option>
                                            <option value="{{ 'own' }}">Own</option>
                                        </select>
                                    </div> --}}
                                </div>

                                {{-- Business URL --}}
                                <div class="row">
                                    <div class="col-sm-2 form-group">
                                        <label for="business_flat_no">Enter Business Flat Not</label>
                                        <input type="text" class="form-control" id="business_flat_no"
                                            name="business_flat_no" placeholder="Enter Business Flat Not"
                                            value="{{ $data->business_flat_no }}">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="business_house_no">Enter Business House No</label>
                                        <input type="text" class="form-control" id="business_house_no"
                                            name="business_house_no" placeholder="Enter Business House No"
                                            value="{{ $data->business_house_no }}">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="business_road_no">Enter Business Road No</label>
                                        <input type="text" class="form-control" id="business_road_no"
                                            name="business_road_no" placeholder="Enter Business Road No"
                                            value="{{ $data->business_road_no }}">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="business_thana">Enter Business Thana</label>
                                        <input type="text" class="form-control" id="business_thana" name="business_thana"
                                            placeholder="Enter Business Road No" value="{{ $data->business_thana }}">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="business_ward">Enter Business Ward</label>
                                        <input type="text" class="form-control" id="business_ward" name="business_ward"
                                            placeholder="Enter Business Ward" value="{{ $data->business_ward }}">
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="business_district">Enter Business District</label>
                                        <input type="text" class="form-control" id="business_district"
                                            name="business_district" placeholder="Enter Business District"
                                            value="{{ $data->business_district }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="business_trade_license_no">Enter Trade License</label>
                                        <input type="text" class="form-control" id="business_trade_license_no"
                                            name="business_trade_license_no" placeholder="Enter Trade License"
                                            value="{{ $data->business_trade_license_no }}">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="business_trade_license_issuing_office">Enter Trade License issuing
                                            Office</label>
                                        <textarea class="form-control" id="business_trade_license_issuing_office"
                                            name="business_trade_license_issuing_office"
                                            placeholder="Enter Trade License issuing Office">{{ $data->business_trade_license_issuing_office }}</textarea>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="business_last_renewal_date">Trade License renewal date</label>
                                        <input type="date" class="form-control" id="business_last_renewal_date"
                                            name="business_last_renewal_date" placeholder="Enter Trade License renewal date"
                                            value="{{ $data->business_last_renewal_date }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="business_registration_no">Enter Business Registration No</label>
                                        <input type="number" class="form-control" id="business_registration_no"
                                            name="business_registration_no" placeholder="Enter Business Registration No"
                                            value="{{ $data->business_registration_no }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4 form-group">
                                        <label for="business_contact__person_name_en">Enter Business Contact Person
                                            Name</label>
                                        <input type="text" class="form-control" id="business_contact__person_name_en"
                                            name="business_contact__person_name_en"
                                            placeholder="Enter Business Contact Person Name"
                                            value="{{ $data->business_contact__person_name_en }}">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="business_contact_person_address">Enter Business Contact Person
                                            Address</label>
                                        <input type="text" class="form-control" id="business_contact_person_address"
                                            name="business_contact_person_address"
                                            placeholder="Enter Business Contact Person Address"
                                            value="{{ $data->business_contact_person_address }}">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="business_contact_person_mobile">Enter Business Contact Person
                                            Mobile</label>
                                        <input type="text" class="form-control" id="business_contact_person_mobile"
                                            name="business_contact_person_mobile"
                                            placeholder="Enter Business Contact Person Mobile"
                                            value="{{ $data->business_contact_person_mobile }}">
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="business_contact_person_email">Enter Business Contact Person
                                            Email</label>
                                        <input type="text" class="form-control" id="business_contact_person_email"
                                            name="business_contact_person_email"
                                            placeholder="Enter Business Contact Person Email"
                                            value="{{ $data->business_contact_person_email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6 flex-end">
                                        <input type="submit" value="Update" class="form-control btn-info">
                                    </div>

                                </div>
                                <!-- /.form group -->
                            </div>



                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </form>
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('scripts')
    {{-- @include('backend.pages.roles.partials.scripts') --}}
    <script>
        $(document).ready(function() {

            $('#datepicker').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                }
            });
            $(".date-picker-year").focus(function() {
                $(".ui-datepicker-month").hide();
            });

            let jq_required = $(".jq_required");
            jq_required.find("label").css("color", "#A80101");
            // jq_required.find('input').prop('required', true);
            // jq_required.find('textarea').prop('required', true);
            // jq_required.find('select').prop('required', true);

            let applicantIsOwner = $("#applicantIsOwner");
            $(applicantIsOwner).change(function() {
                let owners_info = $("#owners_info");
                if (this.checked) {
                    owners_info.find('input').prop('disabled', true);

                    // Required false when applicant & Owner same
                    owners_info.find("label").css("color", "#121212");
                    // owners_info.find('input').prop('required', false);
                } else {
                    $("#owners_info input").prop('disabled', false);

                    // Required True when applicant & Owner not-same
                    owners_info.find("label").css("color", "#A80101");
                    // owners_info.find('input').prop('required', true);
                }
            })
        });
    </script>
@endsection
