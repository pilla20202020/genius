<?php

namespace App\Http\Controllers\Graduate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Graduate\GraduateRequest;
use App\Imports\CustomerImport;
use App\Imports\GraduateImport;
use App\Modules\Service\Graduate\GraduateService;
use Illuminate\Http\Request;
use Excel;


class GraduateController extends Controller
{
    protected $graduate;

    function __construct(GraduateService $graduate)
    {
        $this->graduate = $graduate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $graduate = $this->graduate->paginate();
        return view('graduate.index',compact('graduate'));
    }

    public function graduateStatus($status)
    {
        //
        $graduate = $this->graduate->paginate();
        return view('graduate.index',compact('graduate','status'));
        
    }

    

    public function getAllData()
    {
        // dd($this->role);
        return $this->graduate->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('graduate.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GraduateRequest $request)
    {
        //

        if($graduate = $this->graduate->create($request->all())) {
            Toastr()->success('Graduate Created Successfully','Success');
            return redirect()->route('graduate.index');

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
        //
        $graduate = $this->graduate->find($id);
        return view('graduate.edit',compact('graduate'));
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
        //
        if($this->graduate->update($id,$request->all()))
        {
            Toastr()->success('Graduate Updated Successfully','Success');
            return redirect()->route('graduate.index');
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
        //
        $graduate = $this->graduate->delete($id);
        return response()->json(['status'=>true]);
    }

    public function importGraduate() {
        return view('graduate.import');
    }


    public function storeImportCustomer(Request $request)
    {   
        try {
            $validatedata = $request->validate([
                'file'=> 'required|mimes:xls,xlsx',
            ]);
            Excel::import(new CustomerImport,request()->file('file'));
            Toastr()->success('Graduate Imported Successfully','Success');
            return redirect()->route('graduate.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', __('Invalid File Structure!'));
        }
       
        
        // Session::flash('success', 'Selected list of student were imported successfully.');
        

    }

    
}
