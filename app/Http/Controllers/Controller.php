<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use DB;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function numberFormat($id)
    {

        return "here we can format mobile numbers 'https://verify-network.ekshop.gov.bd/number-format/15928' all ids greater than 15928 will format";

        $i = 1;

        $numberObj  = DB::table('business_listings')->select(['mobile', 'id'])->where('id', '>', $id)->get();
        //return $numberObj;

        foreach ($numberObj as $number) {

            if (strlen($number->mobile) == 11) {
                continue;
            }

            if (empty($number->mobile)) {
                continue;
            }

            if (strlen($number->mobile) == NULL) {
                continue;
            }

            if ($i == 100) {
                return 'ID = ' . $number->id;
            }


            $data = Http::get('https://smsc.ekshop.world/number-validation', ['number' =>  $number->mobile]);

            if ($data['code'] == 200) {

                $i++;

                DB::table('business_listings')->where('id', $number->id)->update(['mobile' => $data['formatted number']]);
            }

            continue;
        }
    }
}
