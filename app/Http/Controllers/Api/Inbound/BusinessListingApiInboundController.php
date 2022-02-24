<?php

namespace App\Http\Controllers\API\Inbound;

use App\Http\Controllers\Controller;
use App\Models\BusinessListing;
use App\Models\Company;
use App\Models\Setting;
use Illuminate\Http\Request;

class BusinessListingApiInboundController extends Controller
{
    public function str_check($str)
    {
        if (is_null($str)) {
            return "";
        } else {
            $str = preg_replace("/\r|\n/", "", $str);
            return $str;
        }
    }

    public function inputValidate(Request $request)
    {
        // return $request->all();

        if (!$request->company) {
            return response()->json([
                'code' => 400,
                'reason' => 'No company provided'
            ], 400);
        }

        $company = Company::where('name_en', $request->company)
            ->orWhere('name_bn', $request->company)
            ->first();

        if (empty($company)) {
            return response()->json([
                'code' => 202,
                'reason' => 'This Company is not listed'
            ], 202);
        }

        $token = $company->company_token; //'VQW5P7P5EU';

        $setting = Setting::first();
        $globalToken = "VQW5P7P5EU";
        if (!empty($setting)) {
            $globalToken = $setting->token;
        }




        if (!$request->header('token')) {
            return response()->json([
                'code' => 400,
                'reason' => 'No token provided'
            ], 400);
        }

        //$request->header('token') != $globalToken
        if ($request->header('token') == $globalToken) {
        } else {
            if ($request->header('token') != $token) {
                return response()->json([
                    'code' => 401,
                    'reason' => 'Unauthorized access'
                ], 401);
            }
        }



        if (!$request->operation_type) {
            return response()->json([
                'code' => 401,
                'reason' => 'No operation_type  provided'
            ], 401);
        }
    }

    public function getData(Request $request)
    {

        if (!isset($request->member_id)) {
            return response()->json([
                'code' => 401,
                'reason' => 'No member_id provided'
            ], 401);
        }

        $company = Company::where('name_en', $request->company)
            ->orWhere('name_bn', $request->company)
            ->first();


        $select = [
            'active',
            'member_id',
            'applicant_name_bn',
            'applicant_name_en',
            'permanent_address',
            'present_address',
            'nid',
            'date_of_birthday',
            'mobile',

            'business_web_url',
            'facebook_url',
            'business_name_bn',
            'business_name_en',
            'business_address_bn',
            'business_address_en',
            'business_mobile',
            'business_phone',
            'business_email',
            'business_categories_id',
            'business_types_id',
            'applicant_father_name as father_name',
            'applicant_mother_name as mother_name',
            'applier_designation',
            'business_office_type',
            'business_owner_name',
            'business_flat_no',
            'business_house_no',
            'business_road_no',
            'business_thana',
            'business_ward',
            'business_district',

            'business_owner1_designation',
            'business_owner1_name',
            'business_owner1_nid',
            'business_owner1_address',
            'business_owner1_mobile',
            'business_owner1_email',

            'business_owner2_designation',
            'business_owner2_name',
            'business_owner2_nid',
            'business_owner2_address',
            'business_owner2_mobile',
            'business_owner2_email',

            'business_owner3_designation',
            'business_owner3_name',
            'business_owner3_nid',
            'business_owner3_address',
            'business_owner3_mobile',
            'business_owner3_email',

            'business_trade_license_no',
            'business_trade_license_issuing_office',
            'business_last_renewal_date',
            'business_registration_no',



            'business_contact__person_name_en',
            'business_contact_person_address',
            'business_contact_person_mobile',
            'business_contact_person_email',

            'business_year',


            // Company
            'name_en',
            'name_bn',
            'address_en',
            'address_bn',
            'phone_no',
            'mobile_no',
            'email',
            'other_business_category'
        ];


        if ($request->request_type && $request->request_type == 'all') {
            $allData = BusinessListing::join('companies', 'companies.id', 'business_listings.companies_id')
                ->where('active', 1)
                ->select($select)
                ->get();
        } else {

            $allData = BusinessListing::join('companies', 'companies.id', 'business_listings.companies_id')
                ->where('companies.name_en', $request->company)
                ->where('business_listings.member_id', $request->member_id)
                ->where('active', 1)
                ->where('companies_id', $company->id)
                // ->orWhere('business_listings.mobile', 'like', '%' . $request->member_id . '%')
                ->select($select)
                ->get();
        }

        if (count($allData) > 0) {

            foreach ($allData as $data) {

                $other_business_category = ($this->str_check($data->business_categories_id) == 5) ? $this->str_check($data->other_business_category) : '';

                $singleData = [
                    'member_id' => $data->member_id,
                    'application_type' => 0,
                    'name' => ($this->str_check($data->applicant_name_bn)),
                    'applicant_name_eng' => $this->str_check($data->applicant_name_en),
                    'permanent_address' => $this->str_check($data->permanent_address),
                    'present_address' => $this->str_check($data->present_address),
                    'national_id_no' => $this->str_check($data->nid),
                    'dob' => date("Y-m-d", strtotime($this->str_check($data->dob))),
                    'mobile' => $this->str_check($data->mobile),
                    'applier_designation' => $this->str_check($data->applier_designation),

                    'company_name_bangla' => $this->str_check(($data->business_name_bn == null) ? $data->name_bn : $data->business_name_bn),
                    'company_name' => $this->str_check(($data->business_name_en == null) ? $data->name_en : $data->business_name_en),
                    'business-web-url' => $this->str_check($data->business_web_url),
                    'facebook_url' => $this->str_check($data->facebook_url),
                    'company_address_bangla' => $this->str_check(($data->business_address_bn == null) ? $data->address_bn : $data->business_address_bn),
                    'company_address' => $this->str_check(($data->business_address_en == null) ? $data->address_en : $data->business_address_en),
                    'company_phone_no' => $this->str_check(($data->business_phone == null) ? $data->phone_no : $data->business_phone),
                    'company_mobile_no' => $this->str_check(($data->business_mobile == null) ? $data->mobile_no : $data->business_mobile),
                    'company_email' => $this->str_check(($data->business_email == null) ? $data->email : $data->business_email),

                    'form-13481635411341281' => $this->str_check($data->business_office_type),
                    'form-13481635524729815' => $this->str_check($data->business_owner_name),
                    'form-13481635331452608' => $this->str_check($data->business_flat_no),
                    'form-13481635331454620' => $this->str_check($data->business_house_no),
                    'form-13481635331456329' => $this->str_check($data->business_road_no),
                    'form-13481635331458822' => $this->str_check($data->business_ward),
                    'form-13481635331461684' => $this->str_check($data->business_thana),
                    'form-13481635331463880' => $this->str_check($data->business_district),

                    'company_owner_phone_no' => $this->str_check($data->business_owner1_mobile),
                    'company_owner_mobile_no' => $this->str_check($data->business_owner1_mobile),
                    'company_owner_email' => $this->str_check($data->business_owner1_email),
                    'company_landowner_nid' => $this->str_check($data->business_owner1_nid),


                    'trade_license_no' => $this->str_check($data->business_trade_license_no),
                    'trade_license_issuing_office' => $this->str_check($data->business_trade_license_issuing_office),
                    'form-13481635397322072' => $this->str_check($data->business_last_renewal_date),
                    'company_registration_no' => $this->str_check($data->business_registration_no),

                    'form-13481635332115695' => $this->str_check($data->business_contact__person_name_en),
                    'form-13481635332141380' => $this->str_check($data->business_contact_person_address),
                    'form-13481635332174551' => $this->str_check($data->business_contact_person_mobile),
                    'form-13481635332196266' => $this->str_check($data->business_contact_person_email),

                    'ubid_bisiness_type' => $this->str_check($data->business_types_id),

                    'form-designation' => $this->str_check($data->business_owner1_designation),
                    'owner_nid' => $this->str_check($data->business_owner1_nid),
                    'owner_name' => $this->str_check($data->business_owner1_name),
                    'owner_address' => $this->str_check($data->business_owner1_address),
                    'owner_mobile' => $this->str_check($data->business_owner1_mobile),
                    'owner_email' => $this->str_check($data->business_owner1_email),

                    'G-2form-designation' => $this->str_check($data->business_owner2_designation),
                    'G-2owner_nid' => $this->str_check($data->business_owner2_nid),
                    'G-2owner_name' => $this->str_check($data->business_owner2_name),
                    'G-2owner_address' => $this->str_check($data->business_owner2_address),
                    'G-2owner_mobile' => $this->str_check($data->business_owner2_mobile),
                    'G-2owner_email' => $this->str_check($data->business_owner2_email),

                    'G-1form-designation' => $this->str_check($data->business_owner3_designation),
                    'G-1owner_nid' => $this->str_check($data->business_owner3_nid),
                    'G-1owner_name' => $this->str_check($data->business_owner3_name),
                    'G-1owner_address' => $this->str_check($data->business_owner3_address),
                    'G-1owner_mobile' => $this->str_check($data->business_owner3_mobile),
                    'G-1owner_email' => $this->str_check($data->business_owner3_email),

                    'ubid_business_category' => $this->str_check($data->business_categories_id),
                    'other_business_type' => $other_business_category,
                    'form-13481635413101234' => $this->str_check($data->business_year),

                    'bin_no' => '',
                    'tin_no' => '',
                    'form-13481635335214579' => '',
                    'fid' => '',
                    'is_complete' => '',
                    'auto_to_whom' => '',
                    'auto_office_name' => '',
                    'auto_office_address' => '',
                    'office_attention_desk_unit' => '',

                    '1' => 'G1',

                    'name_en' => ($this->str_check($data->name)),
                    'mname' => ($this->str_check($data->mother_name)),
                    'fname' => ($this->str_check($data->father_name))
                ];

                $responseData[] = $singleData;
            }

            return response()->json([
                'code' => 200,
                'data' => $responseData,
            ], 200);
        }

        return response()->json([
            'code' => 202,
            'reason' => 'member id not matched'
        ], 202);
    }

    public function setData(Request $request)
    {

        // Input Request validate
        if (!empty($this->inputValidate($request))) {
            return $this->inputValidate($request);
        }

        if ($request->operation_type == 'create') {
            return $this->create($request);
        } else if ($request->operation_type == 'update') {
            return $this->update($request);
        } else if ($request->operation_type == 'get-data') {
            return $this->getData($request);
        } else {
            return response()->json([
                'code' => 401,
                'reason' => "only 'create', 'update' & 'get-data' operation type allowed",
            ], 401);
        }
    }

    // public function issetCheck($data){
    //     if(isset($data)){
    //         return $data;
    //     }else{
    //         return null;
    //     }
    // }

    public function create(Request $request)
    {
        // return $request->data;
        $data_list = $request->data;

        $invalid_inputs = [];
        $duplicate_inputs = [];
        $inserted_data_amount = 0;
        $duplicate_data_amount = 0;

        $company = Company::where('name_en', $request->company)
            ->orWhere('name_bn', $request->company)
            ->first();


        foreach ($data_list as $item) {

            $item = (object)$item;

            // return $item->companies_id;

            // if (!isset($item->member_id)) {
            //     $no_member_id_inputs[] = $item;
            //     continue;
            // }

            if (!isset($item->mobile) && (!isset($item->applicant_name_en) || !isset($item->applicant_name_bn))) {
                $invalid_inputs[] = $item;
                continue;
            }

            if (isset($item->member_id)) {
                $companyBaseItem = BusinessListing::where('companies_id', $company->id)
                    ->where(function ($query) use ($item) {
                        $query->where('member_id', $item->member_id)
                            ->orWhere('mobile', $item->mobile);
                    })
                    ->first();
            } else {
                $companyBaseItem = BusinessListing::where('companies_id', $company->id)
                    ->Where('mobile', $item->mobile)
                    ->first();
            }



            // return $companyBaseItem;
            if (!empty($companyBaseItem)) {
                $duplicate_inputs[] = $item;
                $duplicate_data_amount++;
                continue;
            }

            $data['applicant_type'] = isset($item->applicant_type) ? $item->applicant_type : null;
            $data['business_categories_id'] = isset($item->business_categories_id) ? $item->business_categories_id : null;
            $data['business_types_id'] = isset($item->business_types_id) ? $item->business_types_id : null;
            $data['companies_id'] = $company->id;
            $data['member_id'] = isset($item->member_id) ? $item->member_id : null;

            $data['db_id'] = isset($item->db_id) ? $item->db_id : null;

            $data['applicant_name_en'] = isset($item->applicant_name_en) ? $item->applicant_name_en : null;
            $data['applicant_name_bn'] = isset($item->applicant_name_bn) ? $item->applicant_name_bn : null;

            $data['mobile'] = isset($item->mobile) ? $item->mobile : null;
            $data['nid'] = isset($item->nid) ? $item->nid : null;
            $data['date_of_birthday'] = isset($item->date_of_birthday) ? $item->date_of_birthday : null;

            $data['applicant_father_name'] = isset($item->applicant_father_name) ? $item->applicant_father_name : null;
            $data['applicant_mother_name'] = isset($item->applicant_mother_name) ? $item->applicant_mother_name : null;

            $data['present_address'] = isset($item->present_address) ? $item->present_address : null;
            $data['permanent_address'] = isset($item->permanent_address) ? $item->permanent_address : null;


            $data['applier_designation'] = isset($item->applier_designation) ? $item->applier_designation : null;
            $data['business_name_en'] = isset($item->business_name_en) ? $item->business_name_en : null;
            $data['business_name_bn'] = isset($item->business_name_bn) ? $item->business_name_bn : null;
            $data['business_year'] = isset($item->business_year) ? $item->business_year : null;
            $data['business_address_en'] = isset($item->business_address_en) ? $item->business_address_en : null;
            $data['business_address_bn'] = isset($item->business_address_bn) ? $item->business_address_bn : null;
            $data['business_phone'] = isset($item->business_phone) ? $item->business_phone : null;
            $data['business_mobile'] = isset($item->business_mobile) ? $item->business_mobile : null;
            $data['business_email'] = isset($item->business_email) ? $item->business_email : null;
            $data['business_web_url'] = isset($item->business_web_url) ? $item->business_web_url : null;
            $data['facebook_url'] = isset($item->facebook_url) ? $item->facebook_url : null;
            $data['business_office_type'] = isset($item->business_office_type) ? $item->business_office_type : null;
            $data['business_owner_name'] = isset($item->business_owner_name) ? $item->business_owner_name : null;
            $data['business_flat_no'] = isset($item->business_flat_no) ? $item->business_flat_no : null;
            $data['business_house_no'] = isset($item->business_house_no) ? $item->business_house_no : null;
            $data['business_road_no'] = isset($item->business_road_no) ? $item->business_road_no : null;
            $data['business_thana'] = isset($item->business_thana) ? $item->business_thana : null;
            $data['business_ward'] = isset($item->business_ward) ? $item->business_ward : null;
            $data['business_district'] = isset($item->business_district) ? $item->business_district : null;
            $data['business_owner_phone'] = isset($item->business_owner_phone) ? $item->business_owner_phone : null;
            $data['business_owner_mobile'] = isset($item->business_owner_mobile) ? $item->business_owner_mobile : null;
            $data['business_owner_email'] = isset($item->business_owner_email) ? $item->business_owner_email : null;
            $data['business_land_owner_nid'] = isset($item->business_land_owner_nid) ? $item->business_land_owner_nid : null;
            $data['business_trade_license_no'] = isset($item->business_trade_license_no) ? $item->business_trade_license_no : null;
            $data['business_trade_license_issuing_office'] = isset($item->business_trade_license_issuing_office) ? $item->business_trade_license_issuing_office : null;
            $data['business_last_renewal_date'] = isset($item->business_last_renewal_date) ? $item->business_last_renewal_date : null;
            $data['business_registration_no'] = isset($item->business_registration_no) ? $item->business_registration_no : null;

            $data['business_contact__person_name_en'] = isset($item->business_contact__person_name_en) ? $item->business_contact__person_name_en : null;
            $data['business_contact_person_address'] = isset($item->business_contact_person_address) ? $item->business_contact_person_address : null;
            $data['business_contact_person_mobile'] = isset($item->business_contact_person_mobile) ? $item->business_contact_person_mobile : null;
            $data['business_contact_person_email'] = isset($item->business_contact_person_email) ? $item->business_contact_person_email : null;
            $data['business_ubid_business_type'] = isset($item->business_ubid_business_type) ? $item->business_ubid_business_type : null;
            $data['business_form_designation'] = isset($item->business_form_designation) ? $item->business_form_designation : null;

            $data['business_owner1_designation'] = isset($item->business_owner1_designation) ? $item->business_owner1_designation : null;


            $data['business_owner1_name'] = isset($item->business_owner_name) ? $item->business_owner_name : null;
            $data['business_owner1_nid'] = isset($item->business_owner_nid) ? $item->business_owner_nid : null;
            $data['business_owner1_address'] = isset($item->business_owner_address) ? $item->business_owner_address : null;
            $data['business_owner1_mobile'] = isset($item->business_owner_mobile) ? $item->business_owner_mobile : null;
            $data['business_owner1_email'] = isset($item->business_owner_email) ? $item->business_owner_email : null;


            $data['business_owner2_designation'] = isset($item->business_owner2_designation) ? $item->business_owner2_designation : null;
            $data['business_owner2_name'] = isset($item->business_owner2_name) ? $item->business_owner2_name : null;
            $data['business_owner2_nid'] = isset($item->business_owner2_nid) ? $item->business_owner2_nid : null;
            $data['business_owner2_address'] = isset($item->business_owner2_address) ? $item->business_owner2_address : null;
            $data['business_owner2_mobile'] = isset($item->business_owner2_mobile) ? $item->business_owner2_mobile : null;
            $data['business_owner2_email'] = isset($item->business_owner2_email) ? $item->business_owner2_email : null;

            $data['business_owner3_designation'] = isset($item->business_owner3_designation) ? $item->business_owner3_designation : null;
            $data['business_owner3_name'] = isset($item->business_owner3_name) ? $item->business_owner3_name : null;
            $data['business_owner3_nid'] = isset($item->business_owner3_nid) ? $item->business_owner3_nid : null;
            $data['business_owner3_address'] = isset($item->business_owner3_address) ? $item->business_owner3_address : null;
            $data['business_owner3_mobile'] = isset($item->business_owner3_mobile) ? $item->business_owner3_mobile : null;
            $data['business_owner3_email'] = isset($item->business_owner3_email) ? $item->business_owner3_email : null;

            $data['business_bin_no'] = isset($item->business_bin_no) ? $item->business_bin_no : null;
            $data['business_tin_no'] = isset($item->business_tin_no) ? $item->business_tin_no : null;

            BusinessListing::create($data);
            $inserted_data_amount++;
        }

        if (count($invalid_inputs) || count($duplicate_inputs)) {
            return response()->json([
                'code' => 201,
                'reason' => $inserted_data_amount . " data Created Successfully",
                'invalid inputs (Name & Mobile are required)' => $invalid_inputs,
                'duplicate inputs' => $duplicate_data_amount,
            ], 201);
        }

        return response()->json([
            'code' => 201,
            'reason' => "Created Successfully",
        ], 201);
    }



    public function update(Request $request)
    {
        $data_list = $request->data;
        $no_member_id_inputs = [];
        // $duplicate_inputs = [];
        $updated_data_amount = 0;
        $no_data_found_amount = 0;



        if (!$request->member_id) {
            return response()->json([
                'code' => 401,
                'reason' => 'No member_id provided'
            ], 401);
        }

        $company = Company::where('name_en', $request->company)
            ->orWhere('name_bn', $request->company)
            ->first();

        $item = $request->data;
        // return $item;
        $item = (object)$item;

        $companyBaseItem = BusinessListing::where('companies_id', $company->id)
            ->where('member_id', $request->member_id)
            ->first();

        // return $companyBaseItem;

        if (empty($companyBaseItem)) {
            return response()->json([
                'code' => 202,
                'reason' => "No Data Found",
            ], 202);
        }


        isset($item->applicant_type) ?  $companyBaseItem->applicant_type  =  $item->applicant_type : null;
        isset($item->business_categories_id) ? $companyBaseItem->business_categories_id  = $item->business_categories_id : null;
        isset($item->business_types_id) ? $companyBaseItem->business_types_id  = $item->business_types_id : null;
        // isset($item->companies_id) ? $companyBaseItem->companies_id  = $item->companies_id : null;
        // isset($item->member_id) ? $companyBaseItem->member_id  = $item->member_id : null;

        isset($item->db_id) ? $companyBaseItem->db_id  = $item->db_id : null;

        isset($item->applicant_name_en) ? $companyBaseItem->applicant_name_en  = $item->applicant_name_en : null;
        isset($item->applicant_name_bn) ? $companyBaseItem->applicant_name_bn  = $item->applicant_name_bn : null;

        isset($item->mobile) ? $companyBaseItem->mobile  = $item->mobile : null;
        isset($item->nid) ? $companyBaseItem->nid  = $item->nid : null;
        isset($item->date_of_birthday) ? $companyBaseItem->date_of_birthday  = $item->date_of_birthday : null;

        isset($item->applicant_father_name) ? $companyBaseItem->applicant_father_name  = $item->applicant_father_name : null;
        isset($item->applicant_mother_name) ? $companyBaseItem->applicant_mother_name  = $item->applicant_mother_name : null;

        isset($item->present_address) ? $companyBaseItem->present_address  = $item->present_address : null;
        isset($item->permanent_address) ? $companyBaseItem->permanent_address  = $item->permanent_address : null;


        isset($item->applier_designation) ? $companyBaseItem->applier_designation  = $item->applier_designation : null;
        isset($item->business_name_en) ? $companyBaseItem->business_name_en  = $item->business_name_en : null;
        isset($item->business_name_bn) ? $companyBaseItem->business_name_bn  = $item->business_name_bn : null;
        isset($item->business_year) ? $companyBaseItem->business_year  = $item->business_year : null;
        isset($item->business_address_en) ? $companyBaseItem->business_address_en  = $item->business_address_en : null;
        isset($item->business_address_bn) ?  $companyBaseItem->business_address_bn  = $item->business_address_bn : null;
        isset($item->business_phone) ? $companyBaseItem->business_phone  = $item->business_phone : null;
        isset($item->business_mobile) ? $companyBaseItem->business_mobile  = $item->business_mobile : null;
        isset($item->business_email) ? $companyBaseItem->business_email  = $item->business_email : null;
        isset($item->business_web_url) ? $companyBaseItem->business_web_url  = $item->business_web_url : null;
        isset($item->facebook_url) ? $companyBaseItem->facebook_url  = $item->facebook_url : null;
        isset($item->business_office_type) ? $companyBaseItem->business_office_type  = $item->business_office_type : null;
        isset($item->business_owner_name) ? $companyBaseItem->business_owner_name  = $item->business_owner_name : null;
        isset($item->business_flat_no) ? $companyBaseItem->business_flat_no  = $item->business_flat_no : null;
        isset($item->business_house_no) ? $companyBaseItem->business_house_no  = $item->business_house_no : null;
        isset($item->business_road_no) ? $companyBaseItem->business_road_no  = $item->business_road_no : null;
        isset($item->business_thana) ? $companyBaseItem->business_thana  = $item->business_thana : null;
        isset($item->business_ward) ? $companyBaseItem->business_ward  = $item->business_ward : null;
        isset($item->business_district) ?  $companyBaseItem->business_district  = $item->business_district : null;
        isset($item->business_owner_phone) ? $companyBaseItem->business_owner_phone  = $item->business_owner_phone : null;
        isset($item->business_owner_mobile) ? $companyBaseItem->business_owner_mobile  = $item->business_owner_mobile : null;
        isset($item->business_owner_email) ? $companyBaseItem->business_owner_email  = $item->business_owner_email : null;
        isset($item->business_land_owner_nid) ? $companyBaseItem->business_land_owner_nid  = $item->business_land_owner_nid : null;
        isset($item->business_trade_license_no) ? $companyBaseItem->business_trade_license_no  = $item->business_trade_license_no : null;
        isset($item->business_trade_license_issuing_office) ? $companyBaseItem->business_trade_license_issuing_office  = $item->business_trade_license_issuing_office : null;
        isset($item->business_last_renewal_date) ? $companyBaseItem->business_last_renewal_date  = $item->business_last_renewal_date : null;
        isset($item->business_registration_no) ? $companyBaseItem->business_registration_no  = $item->business_registration_no : null;

        isset($item->business_contact__person_name_en) ? $companyBaseItem->business_contact__person_name_en  = $item->business_contact__person_name_en : null;
        isset($item->business_contact_person_address) ? $companyBaseItem->business_contact_person_address  = $item->business_contact_person_address : null;
        isset($item->business_contact_person_mobile) ? $companyBaseItem->business_contact_person_mobile  = $item->business_contact_person_mobile : null;
        isset($item->business_contact_person_email) ? $companyBaseItem->business_contact_person_email  = $item->business_contact_person_email : null;
        isset($item->business_ubid_business_type) ? $companyBaseItem->business_ubid_business_type  = $item->business_ubid_business_type : null;
        isset($item->business_form_designation) ? $companyBaseItem->business_form_designation  = $item->business_form_designation : null;

        isset($item->business_owner1_designation) ?  $companyBaseItem->business_owner1_designation  = $item->business_owner1_designation : null;


        isset($item->business_owner_name) ? $companyBaseItem->business_owner1_name  = $item->business_owner_name : null;
        isset($item->business_owner_nid) ?  $companyBaseItem->business_owner1_nid  = $item->business_owner_nid : null;
        isset($item->business_owner_address) ? $companyBaseItem->business_owner1_address  = $item->business_owner_address : null;
        isset($item->business_owner_mobile) ? $companyBaseItem->business_owner1_mobile  = $item->business_owner_mobile : null;
        isset($item->business_owner_email) ? $companyBaseItem->business_owner1_email  = $item->business_owner_email : null;


        isset($item->business_owner2_designation) ? $companyBaseItem->business_owner2_designation  = $item->business_owner2_designation : null;
        isset($item->business_owner2_name) ? $companyBaseItem->business_owner2_name  = $item->business_owner2_name : null;
        isset($item->business_owner2_nid) ? $companyBaseItem->business_owner2_nid  = $item->business_owner2_nid : null;
        isset($item->business_owner2_address) ? $companyBaseItem->business_owner2_address  = $item->business_owner2_address : null;
        isset($item->business_owner2_mobile) ? $companyBaseItem->business_owner2_mobile  = $item->business_owner2_mobile : null;
        isset($item->business_owner2_email) ? $companyBaseItem->business_owner2_email  = $item->business_owner2_email : null;

        isset($item->business_owner3_designation) ? $companyBaseItem->business_owner3_designation  = $item->business_owner3_designation : null;
        isset($item->business_owner3_name) ? $companyBaseItem->business_owner3_name  = $item->business_owner3_name : null;
        isset($item->business_owner3_nid) ? $companyBaseItem->business_owner3_nid  = $item->business_owner3_nid : null;
        isset($item->business_owner3_address) ? $companyBaseItem->business_owner3_address  = $item->business_owner3_address : null;
        isset($item->business_owner3_mobile) ? $companyBaseItem->business_owner3_mobile  = $item->business_owner3_mobile : null;
        isset($item->business_owner3_email) ? $companyBaseItem->business_owner3_email  = $item->business_owner3_email : null;

        isset($item->business_bin_no) ? $companyBaseItem->business_bin_no  = $item->business_bin_no : null;
        isset($item->business_tin_no) ? $companyBaseItem->business_tin_no  = $item->business_tin_no : null;

        $companyBaseItem->save();
        // BusinessListing::create($data);
        $updated_data_amount++;

        return response()->json([
            'code' => 200,
            'reason' => "Updated Successfully",
        ], 200);
    }
}
