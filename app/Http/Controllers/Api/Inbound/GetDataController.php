<?php

namespace App\Http\Controllers\Api\inbound;

use App\Http\Controllers\Controller;
use App\Models\BusinessListing;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetDataController extends Controller
{
    public function getEcabData()
    {
        // return "getEcabData";
        $eCab = Company::where('name_en', 'eCab')->first();

        while (true) {
            $lastMemberOf_eCab = BusinessListing::where('companies_id', $eCab->id)
                ->orderBy('id', 'DESC')->first();
            if (isset($lastMemberOf_eCab)) {
                // dd($eCab->id, $lastMemberOf_eCab->member_id);
                $memberId = $lastMemberOf_eCab->member_id;
                $memberId++;
                $memberId = str_pad(strval($memberId), 4, "0", STR_PAD_LEFT);
                // dd($memberId);
            } else {
                $memberId = "0001";
                $memberId = str_pad(strval($memberId), 4, "0", STR_PAD_LEFT);
            }

            $eCab_url_for_getting_member_info = "https://e-cab.net/api/member-info";
            $api_key = '$2y$10$JtOY03iJnrRNaDewUa';
            $secret_code = "194565";
            $member_id = $memberId;

            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($eCab_url_for_getting_member_info, [
                    "api_key" => $api_key,
                    "secret_code" => $secret_code,
                    "member_id" => $member_id,
                ]);
                // return $response;
                $responseBody = json_decode($response->body(), true);
                // dd($responseBody['code']);
                if ($responseBody['code'] == 200) {

                    if($responseBody['message'] == 'Member not found'){
                        $memberId++;
                        $memberId = str_pad(strval($memberId), 4, "0", STR_PAD_LEFT);
                        continue;
                    } 

                    if ($responseBody['message'] == 'Single Member Info') {
                        $responseBodyData = $responseBody['data'];

                        $data['applicant_type'] = isset($responseBodyData['application_type']) ? $responseBodyData['application_type'] : null;
                        $data['business_categories_id'] = 5; //Others
                        // $data['business_types_id'] = isset($item->business_types_id) ? $item->business_types_id : null;
                        $data['companies_id'] = $eCab->id;
                        $data['member_id'] = isset($responseBodyData['member_id']) ? $responseBodyData['member_id'] : null;

                        // $data['db_id'] = isset($responseBodyData['']) ? $responseBodyData[''] : null;

                        $data['applicant_name_en'] = isset($responseBodyData['applicant_name_eng']) ? $responseBodyData['applicant_name_eng'] : null;
                        $data['applicant_name_bn'] = isset($responseBodyData['name']) ? $responseBodyData['name'] : null;

                        $data['mobile'] = isset($responseBodyData['mobile']) ? $responseBodyData['mobile'] : null;
                        $data['nid'] = isset($responseBodyData['national_id_no']) ? $responseBodyData['national_id_no'] : null;
                        $data['date_of_birthday'] = isset($responseBodyData['dob']) ? $responseBodyData['dob'] : null;

                        $data['applicant_father_name'] = isset($responseBodyData['fname']) ? $responseBodyData['fname'] : null;
                        $data['applicant_mother_name'] = isset($responseBodyData['mname']) ? $responseBodyData['mname'] : null;

                        $data['present_address'] = isset($responseBodyData['present_address']) ? $responseBodyData['present_address'] : null;
                        $data['permanent_address'] = isset($responseBodyData['permanent_address']) ? $responseBodyData['permanent_address'] : null;

                        $data['applier_designation'] = isset($responseBodyData['applier_designation']) ? $responseBodyData['applier_designation'] : null;
                        $data['business_name_en'] = isset($responseBodyData['company_name']) ? $responseBodyData['company_name'] : null;
                        $data['business_name_bn'] = isset($responseBodyData['company_name_bangla']) ? $responseBodyData['company_name_bangla'] : null;
                        $data['business_year'] = isset($responseBodyData['establishment_year']) ? $responseBodyData['establishment_year'] : null;
                        $data['business_address_en'] = isset($responseBodyData['company_address']) ? $responseBodyData['company_address'] : null;
                        $data['business_address_bn'] = isset($responseBodyData['company_address_bangla']) ? $responseBodyData['company_address_bangla'] : null;
                        $data['business_phone'] = isset($responseBodyData['company_phone_no']) ? $responseBodyData['company_phone_no'] : null;
                        $data['business_mobile'] = isset($responseBodyData['company_mobile_no']) ? $responseBodyData['company_mobile_no'] : null;
                        $data['business_email'] = isset($responseBodyData['company_email']) ? $responseBodyData['company_email'] : null;
                        $data['business_web_url'] = isset($responseBodyData['business-web-ur']) ? $responseBodyData['business-web-ur'] : null;
                        $data['facebook_url'] = isset($responseBodyData['facebook_url']) ? $responseBodyData['facebook_url'] : null;
                        // $data['business_office_type'] = isset($responseBodyData['']) ? $responseBodyData[''] : null;
                        $data['business_owner_name'] = isset($responseBodyData['owner_name']) ? $responseBodyData['owner_name'] : null;
                        // $data['business_flat_no'] = isset($responseBodyData['']) ? $responseBodyData[''] : null;
                        // $data['business_house_no'] = isset($responseBodyData['']) ? $responseBodyData[''] : null;

                        // $data['business_road_no'] = isset($item->business_road_no) ? $item->business_road_no : null;
                        // $data['business_thana'] = isset($item->business_thana) ? $item->business_thana : null;
                        // $data['business_ward'] = isset($item->business_ward) ? $item->business_ward : null;
                        // $data['business_district'] = isset($item->business_district) ? $item->business_district : null;
                        $data['business_owner_phone'] = isset($responseBodyData['company_owner_phone_no']) ? $responseBodyData['company_owner_phone_no'] : null;
                        $data['business_owner_mobile'] = isset($responseBodyData['company_owner_mobile_no']) ? $responseBodyData['company_owner_mobile_no'] : null;
                        $data['business_owner_email'] = isset($responseBodyData['company_owner_email']) ? $responseBodyData['company_owner_email'] : null;
                        $data['business_land_owner_nid'] = isset($responseBodyData['company_landowner_nid']) ? $responseBodyData['company_landowner_nid'] : null;
                        $data['business_trade_license_no'] = isset($responseBodyData['trade_license_no']) ? $responseBodyData['trade_license_no'] : null;
                        $data['business_trade_license_issuing_office'] = isset($responseBodyData['trade_license_issuing_office']) ? $responseBodyData['trade_license_issuing_office'] : null;
                        // $data['business_last_renewal_date'] = isset($responseBodyData['ddd']) ? $responseBodyData['ddd'] : null;
                        // $data['business_registration_no'] = isset($responseBodyData['ddd']) ? $responseBodyData['ddd'] : null;

                        // $data['business_contact__person_name_en'] = isset($responseBodyData['ddd']) ? $responseBodyData['ddd'] : null;
                        // $data['business_contact_person_address'] = isset($responseBodyData['ddd']) ? $responseBodyData['ddd'] : null;
                        // $data['business_contact_person_mobile'] = isset($responseBodyData['ddd']) ? $responseBodyData['ddd'] : null;
                        // $data['business_contact_person_email'] = isset($responseBodyData['ddd']) ? $responseBodyData['ddd'] : null;
                        $data['business_ubid_business_type'] = 5;
                        // $data['business_ubid_business_type'] = isset($responseBodyData['ubid_bisiness_type']) ? $responseBodyData['ubid_bisiness_type'] : null;
                        $data['business_form_designation'] = isset($responseBodyData['form-designation']) ? $responseBodyData['form-designation'] : null;

                        $data['business_owner1_designation'] = isset($responseBodyData['form-designation']) ? $responseBodyData['form-designation'] : null;
                        $data['business_owner1_name'] = isset($responseBodyData['owner_name']) ? $responseBodyData['owner_name'] : null;
                        $data['business_owner1_nid'] = isset($responseBodyData['owner_nid']) ? $responseBodyData['owner_nid'] : null;
                        $data['business_owner1_address'] = isset($responseBodyData['owner_address']) ? $responseBodyData['owner_address'] : null;
                        $data['business_owner1_mobile'] = isset($responseBodyData['owner_mobile']) ? $responseBodyData['owner_mobile'] : null;
                        $data['business_owner1_email'] = isset($responseBodyData['owner_email']) ? $responseBodyData['owner_email'] : null;


                        $data['business_owner2_designation'] = isset($responseBodyData['G-1form-designation']) ? $responseBodyData['G-1form-designation'] : null;
                        $data['business_owner2_name'] = isset($responseBodyData['G-1owner_name']) ? $responseBodyData['G-1owner_name'] : null;
                        $data['business_owner2_nid'] = isset($responseBodyData['G-1owner_nid']) ? $responseBodyData['G-1owner_nid'] : null;
                        $data['business_owner2_address'] = isset($responseBodyData['G-1owner_address']) ? $responseBodyData['G-1owner_address'] : null;
                        $data['business_owner2_mobile'] = isset($responseBodyData['G-1owner_mobile']) ? $responseBodyData['G-1owner_mobile'] : null;
                        $data['business_owner2_email'] = isset($responseBodyData['G-1owner_email']) ? $responseBodyData['G-1owner_email'] : null;

                        $data['business_owner3_designation'] = isset($responseBodyData['G-2form-designation']) ? $responseBodyData['G-2form-designation'] : null;
                        $data['business_owner3_name'] = isset($responseBodyData['G-2owner_name']) ? $responseBodyData['G-2owner_name'] : null;
                        $data['business_owner3_nid'] = isset($responseBodyData['G-2owner_nid']) ? $responseBodyData['G-2owner_nid'] : null;
                        $data['business_owner3_address'] = isset($responseBodyData['G-2owner_address']) ? $responseBodyData['G-2owner_address'] : null;
                        $data['business_owner3_mobile'] = isset($responseBodyData['G-2owner_mobile']) ? $responseBodyData['G-2owner_mobile'] : null;
                        $data['business_owner3_email'] = isset($responseBodyData['G-2owner_email']) ? $responseBodyData['G-2owner_email'] : null;

                        $data['business_bin_no'] = isset($responseBodyData['bin_no']) ? $responseBodyData['bin_no'] : null;
                        $data['business_tin_no'] = isset($responseBodyData['tin_no']) ? $responseBodyData['tin_no'] : null;

                        BusinessListing::create($data);
                    }
                    else {
                        // if member not found
                        break;
                    }
                } else {
                    break;
                }
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
            }
        }
        dd("All Members Data Collection Done");
    }
}
