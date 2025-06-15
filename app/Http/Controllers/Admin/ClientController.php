<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Designation;
use App\Models\Company;
use Auth;
use App\Models\AreaCode;
use App\Models\Category;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Country;

class ClientController extends Controller
{
    public function index()
    {   
        $clientData = Client::orderBy('id','desc')->get();
        $companies = Company::all();
        $areas = AreaCode::all();
        $categories = Category::all();
        $designations = Designation::all();
        return view('admin.client.index',compact('clientData','companies','areas','categories','designations'));
    }

    public function create()
    {	
    	$designationData = Designation::all();
    	$companyData = Company::all();
        $areaCodeData = AreaCode::all();
        $countryData = Country::all();
        $categoryData = Category::all();
        return view('admin.client.create',compact('designationData','companyData','areaCodeData','categoryData','countryData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        
        if(Client::create($data)){
            return redirect()->route('admin.client.index')->with('message','Successfully Client Created');
        }else{
            return redirect()->back();
        }
    }

    public function edit($id)
    {   
        $clientData = Client::where('id',$id)->first();
        $designationData = Designation::all();
    	$companyData = Company::all();
        $areaCodeData = AreaCode::all();
        $categoryData = Category::all();
        $countryData = Country::all();
        return view('admin.client.edit',compact('clientData','designationData','companyData','areaCodeData','categoryData','countryData'));
    }

    public function update(Request $request,$id){

        $request->validate([
            'name' => 'required',
        ]);


        $data = $request->all();
    
        $clientData = Client::find($id);
        if($clientData->update($data)){
            return redirect(route('admin.client.index'))->with('message','Successfully Client Updated');
        }else{
            return redirect()->back()->with('error','Error !! Update Failed');;
        }

    }

    public function destroy($id)
    {
        $clientData = Client::find($id);
        if($clientData->delete()){

            return redirect(route('admin.client.index'))->with('message','Successfully Client Deleted');
        }else{
            return redirect()->back()->with('error','Error !! Delete Failed');
        }
    }    


    public function clientDataExport()
    {
        $clientData = Client::orderBy('id','desc')->get();
        $companies = Company::all();
        $areas = AreaCode::all();
        $categories = Category::all();
        $designations = Designation::all();
        return view('admin.client.clientReport',compact('clientData','companies','areas','categories','designations'));
    }

    public function areaFilter(Request $request)
    {
        $clientData = Client::where('area_code',$request->area_code)->orderBy('id','desc')->get();
        return view('admin.client.clientReport',compact('clientData'));
    }

    public function downloadPdf(Request $request)
    {
    $query = Client::query();

    if ($request->category) {
        $query->whereHas('categoryData', fn($q) => $q->where('name', $request->category));
    }

    if ($request->designation) {
        $query->whereHas('designationData', fn($q) => $q->where('name', $request->designation));
    }

    if ($request->company) {
        $query->whereHas('companyData', fn($q) => $q->where('name', $request->company));
    }

    if ($request->area) {
        $query->whereHas('areaCodeData', fn($q) => $q->where('name', $request->area));
    }

    $clientData = $query->get();

    $pdf = PDF::loadView('admin.client.pdf', compact('clientData'))
              ->setPaper('a4');

    return $pdf->download('clients.pdf');
}


    public function downloadWord()
    {
    // Get the client data, you can modify it as per your need
    $clients = Client::with(['categoryData', 'designationData', 'companyData', 'areaCodeData'])
        ->orderBy('name') // Optional: Alphabetical order
        ->get();

    // Initialize PhpWord
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Set the document's default font
    $phpWord->setDefaultFontName('Arial');
    $phpWord->setDefaultFontSize(12);

    // Add a title or header
    $section->addText("Client Information", ['bold' => true, 'size' => 14]);

    // Loop through each client and add their details to the Word document
    foreach ($clients as $client) {
        // Fetch data for each client and set default if null
        $name = $client->name ?? 'N/A';
        $designation = $client->designationData->name ?? 'N/A';
        $company = $client->companyData->name ?? 'N/A';
        $address = $client->address ?? 'N/A';

        // Add the client data as a formatted paragraph
        $text = "To:\n" . $name . "\n" . $designation . ", " . $company . "\n" . $address . "\n\n";
        
        // Add text to the Word document
        $section->addText($text);
    }

    // Save the Word file to a location within the public storage
    $fileName = 'clients_' . time() . '.docx';
    $filePath = storage_path($fileName);

    // Write the content to the file
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filePath);

    // Return the file as a download and delete it after sending
    return response()->download($filePath)->deleteFileAfterSend(true);
    }
    

}
