<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\PackageRequest;
use App\Modules\Service\Package\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $package;

    function __construct(PackageService $package)
    {
        $this->package = $package;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $package = $this->package->paginate();
        return view('package.index',compact('package'));
    }

    public function getAllData()
    {
        // dd($this->role);
        return $this->package->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('package.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        //
        if($package = $this->package->create($request->all())) {
            Toastr()->success('Package Created Successfully','Success');
            return redirect()->route('package.index');

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
        $package = $this->package->find($id);
        return view('package.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        //
        if($this->package->update($id,$request->all()))
        {
            Toastr()->success('Package Updated Successfully','Success');
            return redirect()->route('package.index');
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
        $package = $this->package->delete($id);
        return response()->json(['status'=>true]);
    }
}
