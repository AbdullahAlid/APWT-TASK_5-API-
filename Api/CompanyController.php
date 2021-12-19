<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

use PDF;

class CompanyController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth'); // Check authentication
        $this->middleware('isAdmin'); // Check if admin is authenticated
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.companies')->with('companies',Company::all());
    }
    public function indexApi()
    {
        return Company::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:11|max:15',
        ],[
            'name.required' => 'Enter Company Name',
            'phone.required' => 'Enter Company Phone Number',
        ]);

        if(Company::create($request->all())) {
            return redirect()->route('company.index')->with("success","Company {$request->name} Successfully Added");
        }
    }
    public function storeApi(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:11|max:15',
        ],[
            'name.required' => 'Enter Company Name',
            'phone.required' => 'Enter Company Phone Number',
        ]);

        if(Company::create($request->all())) {
            return response()->json([
                'status' => 200,
                'message' => 'Company Added Successfully',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $var = Company::find($id);
        return view('pages.admin.company-edit')->with('data', $var);
    }

    public function editApi($id)
    {
        $var = Company::find($id);
        return  $var;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:11|max:15',
        ],[
            'name.required' => 'Enter Company Name',
            'phone.required' => 'Enter Company Phone Number',
        ]);

        $data = Company::find($id);
        $data->name = $request->name;
        $data->licenseNo = $request->licenseNo;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->fee = $request->fee;
        $data->due = $request->due;
        $data->balance = $request->balance;

        if($data->save()) {
            return redirect()->route('company.index')->with("success","Company {$request->name} Successfully Updated");
        }
    }
    public function updateApi(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:11|max:15',
        ],[
            'name.required' => 'Enter Company Name',
            'phone.required' => 'Enter Company Phone Number',
        ]);

        $data = Company::find($id);
        $data->name = $request->name;
        $data->licenseNo = $request->licenseNo;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->fee = $request->fee;
        $data->due = $request->due;
        $data->balance = $request->balance;

        if($data->save()) {
            return response()->json([
                'status' => 200,
                'message' => 'Company updated Successfully',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $var = Company::find($id);
        $name = $var->name;
        $var->delete();
        return redirect()->back()->with("error","Company {$name} Successfully Deleted");
    }
    public function destroyApi($id)
    {
        $var = Company::find($id);
        $name = $var->name;
        $var->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Deleted Successfully',
        ]);
    }


    public function export(){
        /*

        $companies = Company::all();


        $data = [

            'companies' => $companies,

            'date' => date('m/d/Y')

        ];




        $pdf = PDF::loadView('pages.admin.companies',$data);

        $pdf->render();

        $pdf->stream();



        return $pdf->download('itsolutionstuff.pdf');
        */
    }
}
