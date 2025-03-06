<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MagazineSend;
use App\Models\Client;
use App\Models\Magazine;
use Auth;
use Carbon\Carbon;

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
  	
  	public function clientMagazine($id)
    {
    	$clientData = Client::where('id',$id)->first();
    	$magazineSendData = magazineSend::where('client_id',$id)->orderBy('id','desc')->get();
    	return view('admin.client.magazine',compact('clientData','magazineSendData'));
    }

    public function magazineSendStatus($id)
    {
    	$magazineData = magazineSend::where('id',$id)->first();
    	$magazineData->send_status = 'Send';
    	$magazineData->save();
    	return redirect()->back()->with('message','Successfully magazine Send');
    } 

    public function magazineReceiveStatus($id)
    {
        $magazineData = magazineSend::where('id',$id)->first();
        $magazineData->receive_status = 'Received';
        $magazineData->save();
        return redirect()->back()->with('message','Successfully magazine Receive');
    }

}
