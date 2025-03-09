<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagazineSend;
use App\Models\Client;
use App\Models\Magazine;
use Auth;
use Carbon\Carbon;
use Karim007\LaravelSslwirlessSms\Facade\SslWirlessSms;

class MagazineSendController extends Controller
{
    public function index()
    {   
        $magazineData = Magazine::orderBy('id','desc')->get();
        $clientData = Client::orderBy('id','desc')->get();
        return view('admin.magazineSend.index',compact('magazineData','clientData'));
    }

    public function store(Request $request)
    {
    	foreach ($request->client_id as $clientId) {
    		$magazine = new MagazineSend();
    		$magazine->user_id = Auth::user()->id;
    		$magazine->magazine_id = $request->magazine_id;
    		$magazine->client_id = $clientId;
    		$magazine->verify_code = random_int(100000, 999999);
    		$magazine->save();
    	}

        return redirect()->back()->with('message','Successfully Magazine Send');
    }

    public function magazineOverview()
    {
        $magazineData = Magazine::orderBy('id','desc')->get();
        return view('admin.magazine.overview',compact('magazineData'));
    }
  	
  	public function clientMagazine($id)
    {
    	$clientData = Client::where('id',$id)->first();
    	$magazineSendData = magazineSend::where('client_id',$id)->orderBy('id','desc')->get();
    	return view('admin.client.magazine',compact('clientData','magazineSendData'));
    }

    public function magazineSendStatus($id)
    {
    	$magazineData = magazineSend::where('id',$id)->first();
    	$magazineData->send_status = 'Sending Complete';
    	$magazineData->save();

        $client = Client::where('id',$magazineData->client_id)->first();

        $phone_number = $client->phone; // msisdn must be array
        $messageBody = 'Dear '.$client->name.', The latest edition of Bangladesh Ceramic Magazine is here! Packed with exclusive content, trends, and insights just for you. Grab your copy today! Received OTP: '.$magazineData->verify_code.' Received Link: https://e.webaidsolution.com/verify-magazine-received. NB: Please keep this SMS until you receive the magazine. Bangladesh Ceramic Magazine';

        $customer_smsId = uniqid();
        SslWirlessSms::singleSms($phone_number,$messageBody,$customer_smsId);

    	return redirect()->back()->with('message','Successfully magazine Sending Complete');
    } 

    public function magazineReceiveStatus($id)
    {
        $magazineData = magazineSend::where('id',$id)->first();
        $magazineData->send_status = 'Received';
        $magazineData->save();
        return redirect()->back()->with('message','Successfully magazine Receive');
    }

}
