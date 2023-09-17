<?php

namespace App\Http\Controllers\Api\Inbound;

use App\Http\Controllers\Controller;
use App\Models\BusinessListing;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NumberFormatController extends Controller
{
    public function formatMobileNumbers()
    {
        $bsnsListings = BusinessListing::where('is_number_format', 0)
            ->get();

        if (count($bsnsListings)) {
            foreach ($bsnsListings as $key => $item) {
                // echo $item->mobile;
                // return $item;
                $item->mobile = $this->onlyPhoneNumber($item->mobile);
                $item->business_mobile = $this->onlyPhoneNumber($item->business_mobile);
                $item->business_owner_mobile = $this->onlyPhoneNumber($item->business_owner_mobile);
                $item->business_contact_person_mobile = $this->onlyPhoneNumber($item->business_contact_person_mobile);
                $item->business_owner1_mobile = $this->onlyPhoneNumber($item->business_owner1_mobile);
                $item->business_owner2_mobile = $this->onlyPhoneNumber($item->business_owner2_mobile);
                $item->business_owner3_mobile = $this->onlyPhoneNumber($item->business_owner3_mobile);
                $item->is_number_format = 1;
                $item->save();

                echo $item->mobile . " ";
            }

            return response()->json([
                'status' => 200,
                'message' => ($key+1) . " mobile numbers format successfully"
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => "All mobile numbers already formatted."
            ]);
        }
        // return $this->onlyPhoneNumber("+8801685-262326");
    }


    public static function onlyPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
            $areaCode    = substr($phoneNumber, -10, 3);
            $nextThree   = substr($phoneNumber, -7, 3);
            $lastFour    = substr($phoneNumber, -4, 4);

            //$phoneNumber = $countryCode . $areaCode . $nextThree . $lastFour;
            $phoneNumber = $areaCode . $nextThree . $lastFour;
        } else if (strlen($phoneNumber) == 10) {
            $areaCode  = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour  = substr($phoneNumber, 6, 4);

            $phoneNumber = $areaCode . $nextThree . $lastFour;
        } else if (strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour  = substr($phoneNumber, 3, 4);

            $phoneNumber = $nextThree . $lastFour;
        }

        //FOR BD 11 digits
        if (strlen($phoneNumber) == 10) {
            $phoneNumber = '0' . $phoneNumber;
        }

        return trim($phoneNumber);
    }
}
