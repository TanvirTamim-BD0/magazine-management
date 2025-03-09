<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MagazineSend;

class MagazineVerifyController extends Controller
{
    public function verifyMagazineReceive()
    {
        return view('verifyMagazineReceive');
    }

    public function magazineVerify(Request $request)
    {
    	$data = MagazineSend::where('verify_code',$request->verify_code)->first();
    	if (isset($data)) {
    		$data->send_status = 'Received';
    		$data->save();
    		return redirect()->back()->with('message','Successfully verified.');
    	}else{
    		return redirect()->back()->with('error','verify code did not match !!');
    	}
    }
}
