<?php

namespace App\Http\Controllers;


use App\Models\BusinessCategory;
use App\Models\BusinessListing;

use App\Models\BusinessType;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class BusinessListingController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        //get all business types
        $businessType = BusinessType::get();

        //get all business categories
        $businessCategory = BusinessCategory::get();

        //get all business categories
        $companyInfo = Company::get();

        return view('backend.pages.business_listings.index', compact('businessType', 'businessCategory', 'companyInfo'));
    }

    public function store(Request $request)
    {
        // return $request;

        //check if application and owner info same

        // $applicant_is_owner = $request->applicant_is_owner;
        $data['applicant_type'] = $request->applicant_type;
        $data['business_categories_id'] = $request->business_categories_id;
        $data['business_types_id'] = $request->business_types_id;
        $data['companies_id'] = $request->companies_id;
        $data['member_id'] = $request->member_id;

        $data['applicant_name_en'] = $request->applicant_name_en;
        $data['applicant_name_bn'] = $request->applicant_name_bn;

        $data['mobile'] = $request->mobile;
        $data['nid'] = $request->nid;
        $data['date_of_birthday'] = $request->date_of_birthday;

        $data['applicant_father_name'] = $request->applicant_father_name;
        $data['applicant_mother_name'] = $request->applicant_mother_name;

        $data['present_address'] = $request->present_address;
        $data['permanent_address'] = $request->permanent_address;


        $data['applier_designation'] = $request->applier_designation;
        $data['business_name_en'] = $request->business_name_en;
        $data['business_name_bn'] = $request->business_name_bn;
        $data['business_year'] = $request->business_year;
        $data['business_address_en'] = $request->business_address_en;
        $data['business_address_bn'] = $request->business_address_bn;
        $data['business_phone'] = $request->business_phone;
        $data['business_mobile'] = $request->business_mobile;
        $data['business_email'] = $request->business_email;
        $data['business_web_url'] = $request->business_web_url;
        $data['facebook_url'] = $request->facebook_url;
        $data['business_office_type'] = $request->business_office_type;
        $data['business_owner_name'] = $request->business_owner_name;
        $data['business_flat_no'] = $request->business_flat_no;
        $data['business_house_no'] = $request->business_house_no;
        $data['business_road_no'] = $request->business_road_no;
        $data['business_thana'] = $request->business_thana;
        $data['business_ward'] = $request->business_ward;
        $data['business_district'] = $request->business_district;
        $data['business_owner_phone'] = $request->business_owner_phone;
        $data['business_owner_mobile'] = $request->business_owner_mobile;
        $data['business_owner_email'] = $request->business_owner_email;
        $data['business_land_owner_nid'] = $request->business_land_owner_nid;
        $data['business_trade_license_no'] = $request->business_trade_license_no;
        $data['business_trade_license_issuing_office'] = $request->business_trade_license_issuing_office;
        $data['business_last_renewal_date'] = $request->business_last_renewal_date;
        $data['business_registration_no'] = $request->business_registration_no;
        $data['business_contact__person_name_en'] = $request->business_contact__person_name_en;
        $data['business_contact_person_address'] = $request->business_contact_person_address;
        $data['business_contact_person_mobile'] = $request->business_contact_person_mobile;
        $data['business_contact_person_email'] = $request->business_contact_person_email;
        $data['business_ubid_business_type'] = $request->business_ubid_business_type;
        $data['business_form_designation'] = $request->business_form_designation;

        $data['business_owner1_designation'] = $request->business_owner1_designation;


        if ($request->has('applicant_is_owner')) {

            $data['business_owner1_name'] = $request->applicant_name_bn;
            $data['business_owner1_nid'] = $request->nid;
            $data['business_owner1_address'] = $request->permanent_address;
            $data['business_owner1_mobile'] = $request->mobile;
            $data['business_owner1_email'] = $request->business_email;
        } else {
            $data['business_owner1_name'] = $request->business_owner_name;
            $data['business_owner1_nid'] = $request->business_owner_nid;
            $data['business_owner1_address'] = $request->business_owner_address;
            $data['business_owner1_mobile'] = $request->business_owner_mobile;
            $data['business_owner1_email'] = $request->business_owner_email;
        }

        $data['business_owner2_designation'] = $request->business_owner2_designation;
        $data['business_owner2_name'] = $request->business_owner2_name;
        $data['business_owner2_nid'] = $request->business_owner2_nid;
        $data['business_owner2_address'] = $request->business_owner2_address;
        $data['business_owner2_mobile'] = $request->business_owner2_mobile;
        $data['business_owner2_email'] = $request->business_owner2_email;

        $data['business_owner3_designation'] = $request->business_owner3_designation;
        $data['business_owner3_name'] = $request->business_owner3_name;
        $data['business_owner3_nid'] = $request->business_owner3_nid;
        $data['business_owner3_address'] = $request->business_owner3_address;
        $data['business_owner3_mobile'] = $request->business_owner3_mobile;
        $data['business_owner3_email'] = $request->business_owner3_email;

        $data['business_bin_no'] = $request->business_bin_no;
        $data['business_tin_no'] = $request->business_tin_no;

        BusinessListing::create($data);
        return redirect()->route('admin.business_listings.all')->with('message', 'Data Inserted Successfully');
    }

    public function showAll(Request $request)
    {

        if ($request->ajax()) {
            $data = BusinessListing::select('id', 'member_id', 'applicant_name_en', 'mobile')->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $url = "/admin/business-listings/edit/" . $row->id;
                    $delete_url = "/admin/business-listings/delete/" . $row->id;
                    $btn = '<a href="' . $url . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a><a href="' . $delete_url . '" class="btn btn-danger btn-sm btn_delete"><i class="fas fa-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // return view('users');
        return view('backend.pages.business_listings.show');
    }


    public function edit($id)
    {
        $data = BusinessListing::where('id', $id)->with('companies')->first();
        // return $data;
        //get all business types
        $businessType = BusinessType::get();

        //get all business categories
        $businessCategory = BusinessCategory::get();

        //get all business categories
        $companyInfo = Company::get();
        // return $data;
        return view('backend.pages.business_listings.edit', compact('data', 'businessType', 'businessCategory', 'companyInfo'));
    }
    public function delete($id)
    {
        $data = BusinessListing::find($id);
        $data->delete();
        return redirect()->route('admin.business_listings.all')->with('delete_message', 'Data Deleted');
        // return $data;
        // return view('backend.pages.business_listings.edit', compact('data', 'businessType', 'businessCategory', 'companyInfo'));
    }
    public function update(Request $request, $id)
    {
        // return $request->all();

        $data['applicant_type'] = $request->applicant_type;
        $data['business_categories_id'] = $request->business_categories_id;
        $data['business_types_id'] = $request->business_types_id;
        $data['companies_id'] = $request->companies_id;
        $data['member_id'] = $request->member_id;

        $data['applicant_name_en'] = $request->applicant_name_en;
        $data['applicant_name_bn'] = $request->applicant_name_bn;

        $data['mobile'] = $request->mobile;
        $data['nid'] = $request->nid;
        $data['date_of_birthday'] = $request->date_of_birthday;

        $data['applicant_father_name'] = $request->applicant_father_name;
        $data['applicant_mother_name'] = $request->applicant_mother_name;

        $data['present_address'] = $request->present_address;
        $data['permanent_address'] = $request->permanent_address;


        $data['applier_designation'] = $request->applier_designation;
        $data['business_name_en'] = $request->business_name_en;
        $data['business_name_bn'] = $request->business_name_bn;
        $data['business_year'] = $request->business_year;
        $data['business_address_en'] = $request->business_address_en;
        $data['business_address_bn'] = $request->business_address_bn;
        $data['business_phone'] = $request->business_phone;
        $data['business_mobile'] = $request->business_mobile;
        $data['business_email'] = $request->business_email;
        $data['business_web_url'] = $request->business_web_url;
        $data['facebook_url'] = $request->facebook_url;
        $data['business_office_type'] = $request->business_office_type;
        $data['business_owner_name'] = $request->business_owner_name;
        $data['business_flat_no'] = $request->business_flat_no;
        $data['business_house_no'] = $request->business_house_no;
        $data['business_road_no'] = $request->business_road_no;
        $data['business_thana'] = $request->business_thana;
        $data['business_ward'] = $request->business_ward;
        $data['business_district'] = $request->business_district;
        $data['business_owner_phone'] = $request->business_owner_phone;
        $data['business_owner_mobile'] = $request->business_owner_mobile;
        $data['business_owner_email'] = $request->business_owner_email;
        $data['business_land_owner_nid'] = $request->business_land_owner_nid;
        $data['business_trade_license_no'] = $request->business_trade_license_no;
        $data['business_trade_license_issuing_office'] = $request->business_trade_license_issuing_office;
        $data['business_last_renewal_date'] = $request->business_last_renewal_date;
        $data['business_registration_no'] = $request->business_registration_no;
        $data['business_contact__person_name_en'] = $request->business_contact__person_name_en;
        $data['business_contact_person_address'] = $request->business_contact_person_address;
        $data['business_contact_person_mobile'] = $request->business_contact_person_mobile;
        $data['business_contact_person_email'] = $request->business_contact_person_email;
        $data['business_ubid_business_type'] = $request->business_ubid_business_type;
        $data['business_form_designation'] = $request->business_form_designation;

        $data['business_owner1_designation'] = $request->business_owner1_designation;


        if ($request->has('applicant_is_owner')) {

            $data['business_owner1_name'] = $request->applicant_name_bn;
            $data['business_owner1_nid'] = $request->nid;
            $data['business_owner1_address'] = $request->permanent_address;
            $data['business_owner1_mobile'] = $request->mobile;
            $data['business_owner1_email'] = $request->business_email;
        } else {
            $data['business_owner1_name'] = $request->business_owner_name;
            $data['business_owner1_nid'] = $request->business_owner_nid;
            $data['business_owner1_address'] = $request->business_owner_address;
            $data['business_owner1_mobile'] = $request->business_owner_mobile;
            $data['business_owner1_email'] = $request->business_owner_email;
        }

        $data['business_owner2_designation'] = $request->business_owner2_designation;
        $data['business_owner2_name'] = $request->business_owner2_name;
        $data['business_owner2_nid'] = $request->business_owner2_nid;
        $data['business_owner2_address'] = $request->business_owner2_address;
        $data['business_owner2_mobile'] = $request->business_owner2_mobile;
        $data['business_owner2_email'] = $request->business_owner2_email;

        $data['business_owner3_designation'] = $request->business_owner3_designation;
        $data['business_owner3_name'] = $request->business_owner3_name;
        $data['business_owner3_nid'] = $request->business_owner3_nid;
        $data['business_owner3_address'] = $request->business_owner3_address;
        $data['business_owner3_mobile'] = $request->business_owner3_mobile;
        $data['business_owner3_email'] = $request->business_owner3_email;

        $data['business_bin_no'] = $request->business_bin_no;
        $data['business_tin_no'] = $request->business_tin_no;

        // return $data;
        BusinessListing::where('id', $id)
            ->update($data);
        return redirect()->route('admin.business_listings.all')->with('message', 'Successfully Updated Data');
    }

    public function import()
    {

        return view('backend.pages.business_listings.import');
    }

    public function json()
    {
        //get all business types
        $businessType = BusinessType::get();

        //get all business categories
        $businessCategory = BusinessCategory::get();

        //get all business categories
        // $companyInfo = Company::get();

        // $data = file_get_contents(asset('ekshop_merchants.json'));
        $data = file_get_contents(asset('merchant-ekshop_21_march_2023.json'));
        $data = json_decode($data);
        // return $this->jsonKeyCheck($data->Merchant[0]->division);
        // return $data->Merchant[1];
        // return mb_detect_encoding("বুa");
        $allData = $data->Merchant;

        foreach ($allData as $key => $item) {

            if(isset($item->member_id)){
                $existMerchant = BusinessListing::where('member_id',$item->member_id)->get();
            }else{
                echo "member id not found in json <br>";
            }
            
            if(count($existMerchant)){
                // if merchant already exist
                continue;
            }

            $business_address = (isset($item->division) ?  $item->division : '') . ',' . (isset($item->district) ?  $item->district : '') . ',' . (isset($item->upazila) ?  $item->upazila : '') . ',' . (isset($item->union) ?  $item->union : '');
            $business_address = rtrim($business_address, ',');

            // return $business_address;

            $bsns_cat = BusinessCategory::where('name_en', $item->business_category)
                ->orwhere('name_bn', $item->business_category)
                ->first();

            if (!empty($bsns_cat)) {
                $input_data['business_categories_id'] = $bsns_cat->dbid_business_category_id;
            } else {
                $input_data['business_categories_id'] = 5; //5 for other
                $input_data['other_business_category'] = $item->business_category;
            }

            $input_data['applicant_type'] = 0;
            $input_data['member_id'] = (isset($item->member_id) ?  $item->member_id : '');

            $input_data['business_types_id'] = 1; //Sole Proprietorship
            $input_data['companies_id'] = 2; //ekShop id in company table

            if (mb_detect_encoding(isset($item->applicant_name) ?  $item->applicant_name : '') == "UTF-8") {
                $input_data['applicant_name_bn'] =  (isset($item->applicant_name) ?  $item->applicant_name : '');
            } else {
                $input_data['applicant_name_en'] = (isset($item->applicant_name) ?  $item->applicant_name  : '');
            }
            // Name
            if (mb_detect_encoding(isset($item->business_name) ?  $item->business_name : '') == "UTF-8") {
                $input_data['business_name_bn'] =  (isset($item->business_name) ?  $item->business_name : '');
            } else {
                $input_data['business_name_en'] = (isset($item->business_name) ?  $item->business_name : '');
            }
            // Address
            if (mb_detect_encoding((isset($business_address) ?  $business_address : '')) == "UTF-8") {
                $input_data['business_address_bn'] = (isset($business_address) ?  $business_address : '');
            } else {
                $input_data['business_address_en'] = (isset($business_address) ?  $business_address : '');
            }

            $input_data['mobile'] = (isset($item->applicant_mobile) ?  $item->applicant_mobile : '');
            $input_data['business_email'] = (isset($item->applicant_email) ?  $item->applicant_email : '');
            
            // $input_data['business_year'] = (isset($item->joining_year) ?  $item->joining_year : '');

            // temporary code
            if(isset($item->joining_year)){
                $str = $item->joining_year;
                if(preg_match("/2019/i", $str)){
                    $input_data['business_year'] =  "2019";
                }
                else if(preg_match("/2020/i", $str)){
                    $input_data['business_year'] =  "2020";
                }
                else if(preg_match("/2021/i", $str)){
                    $input_data['business_year'] =  "2021";
                }
                else if(preg_match("/2022/i", $str)){
                    $input_data['business_year'] =  "2022";
                }
                else if(preg_match("/2023/i", $str)){
                    $input_data['business_year'] =  "2023";
                }
                else if(preg_match("/2024/i", $str)){
                    $input_data['business_year'] =  "2024";
                }else{
                    $input_data['business_year'] = "";
                }
                
            }else{
                $input_data['business_year'] = "";
            }

            $input_data['business_owner1_name'] = (isset($item->applicant_name) ?  $item->applicant_name : '');
            $input_data['business_owner1_address'] = (isset($business_address) ?  $business_address : '');
            $input_data['business_owner1_mobile'] = (isset($item->applicant_mobile) ?  $item->applicant_mobile : '');
            $input_data['business_owner1_email'] = (isset($item->applicant_email) ?  $item->applicant_email : '');


            BusinessListing::create($input_data);

            $input_data = [];

            // return $business_address;
        }
    }
}