<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institution\InstitutionRequest;
use App\Modules\Service\Institution\InstitutionService;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    protected $institution;

    function __construct(InstitutionService $institution)
    {
        $this->institution = $institution;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $institution = $this->institution->paginate();
        return view('institution.index',compact('institution'));
    }

    public function getAllData()
    {
        // dd($this->role);
        return $this->institution->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('institution.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionRequest $request)
    {
        //
        if($institution = $this->institution->create($request->all())) {
            Toastr()->success('Institution Created Successfully','Success');
            return redirect()->route('institution.index');

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
        $institution = $this->institution->find($id);
        return view('institution.edit',compact('institution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionRequest $request, $id)
    {
        //
        if($this->institution->update($id,$request->all()))
        {
            Toastr()->success('Institution Updated Successfully','Success');
            return redirect()->route('institution.index');
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
        $institution = $this->institution->delete($id);
        return response()->json(['status'=>true]);
    }
}
