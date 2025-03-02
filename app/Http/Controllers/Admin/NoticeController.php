<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use Auth;
use Carbon\Carbon;

class NoticeController extends Controller
{
    public function index()
    {   
        $noticeData = Notice::orderBy('id','desc')->get();
        return view('admin.notice.index',compact('noticeData'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['date'] = Carbon::now()->toDateString();

        if($request->image != ''){
	            $file = $request->file('image');
	            $fileName = time().'.'.$file->getClientOriginalExtension();
	            $destinationPath = public_path('uploads/notice/');
	            $file->move($destinationPath,$fileName);
	            $data['image'] = $fileName;
        	}
        
        if(Notice::create($data)){
            return redirect()->route('admin.notice.index')->with('message','Successfully Notice Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $noticeData = Notice::where('id',$id)->first();
        return view('admin.notice.edit',compact('noticeData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'title' => 'required',
        ]);


        $data = $request->all();
    
        $noticeData = Notice::find($id);

        if($request->image != ''){
            //To remove previous file...
            $destinationPath = public_path('uploads/notice/');
            if(file_exists($destinationPath.$noticeData->image)){
                if($noticeData->image != ''){
                    unlink($destinationPath.$noticeData->image);
                }
            }

            $file = $request->file('image');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath,$fileName);
            $data['image'] = $fileName;
       		 }

        if($noticeData->update($data)){
            return redirect(route('admin.notice.index'))->with('message','Successfully Notice Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $noticeData = Notice::find($id);
        if($noticeData->delete()){

            return redirect(route('admin.notice.index'))->with('message','Successfully Notice Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    
}
