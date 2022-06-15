<?php

namespace App\Http\Controllers\Api\Outbound;

use App\Http\Controllers\Controller;
use App\Models\BusinessListing;
use App\Models\Company;
use Illuminate\Http\Request;

class BusinessListingApiController extends Controller
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
    public function index()
    {
        return 'check';
    }
    public function verify(Request $request)
    {
        // return 'post';
        //Check Validation
        $token = 'VQW5P7P5EU';

        if (!$request->header('token')) {
            return response()->json([
                'code' => 401,
                'reason' => 'No token'
            ], 401);
        }

        if ($request->header('token') != $token) {
            return response()->json([
                'code' => 401,
                'reason' => 'Unauthorized access'
            ], 401);
        }

        if (!$request->member_id) {
            return response()->json([
                'code' => 401,
                'reason' => 'No member_id provided'
            ], 401);
        }

        if (!$request->company) {
            return response()->json([
                'code' => 401,
                'reason' => 'No company provided'
            ], 401);
        }

        $company = Company::where('name_en', $request->company)
            ->orWhere('name_bn', $request->company)
            ->first();
        if (empty($company)) {
            return response()->json([
                'code' => 401,
                'reason' => 'This Company is not listed'
            ], 401);
        }


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

                // return $data;

                $other_business_category = ($this->str_check($data->business_categories_id) == 5) ? $this->str_check($data->other_business_category) : '';

                $singleData = [
                    'member_id' => $data->member_id,
                    'application_type' => 0,
                    'name' => ($this->str_check($data->applicant_name_bn)),
                    'applicant_name_eng' => $this->str_check($data->applicant_name_en),
                    'permanent_address' => $this->str_check($data->permanent_address),
                    'present_address' => $this->str_check($data->present_address),
                    'national_id_no' => $this->str_check($data->nid),
                    'dob' => date("Y-m-d", strtotime($this->str_check($data->date_of_birthday))),
                    'mobile' => $this->str_check($data->mobile),
                    'applier_designation' => $this->str_check($data->applier_designation),

                    'company_name_bangla' => $this->str_check(($data->business_name_bn == null) ? "" : $data->business_name_bn),
                    'company_name' => $this->str_check(($data->business_name_en == null) ? "" : $data->business_name_en),
                    'business-web-url' => $this->str_check($data->business_web_url),
                    'facebook_url' => $this->str_check($data->facebook_url),
                    'company_address_bangla' => $this->str_check(($data->business_address_bn == null) ? "" : $data->business_address_bn),
                    'company_address' => $this->str_check(($data->business_address_en == null) ? "" : $data->business_address_en),
                    'company_phone_no' => $this->str_check(($data->business_phone == null) ? $data->phone_no : $data->business_phone),
                    
                    
                    'company_mobile_no' => $this->str_check(($data->business_mobile == null) ? $data->business_owner1_mobile : $data->business_mobile),
                    // 'company_mobile_no' => $this->str_check($data->mobile_no),
                    
                    
                    
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

                    'name_en' => ($this->str_check($data->applicant_name_en)),
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
            'code' => 401,
            'reason' => 'member id not matched'
        ], 401);
    }
}
