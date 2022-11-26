<?php

namespace App\Http\Controllers\Ceremony;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ceremony\CeremonyRequest;
use App\Modules\Service\Ceremony\CeremonyService;
use App\Modules\Service\Graduation\GraduationService;
use Illuminate\Http\Request;

class CeremonyController extends Controller
{

    protected $graduation, $ceremony;

    function __construct(GraduationService $graduation, CeremonyService $ceremony)
    {
        $this->graduation = $graduation;
        $this->ceremony = $ceremony;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ceremony = $this->ceremony->paginate();
        return view('ceremony.index',compact('ceremony'));
    }

    public function getAllData()
    {
        // dd($this->role);
        return $this->ceremony->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $graduations = $this->graduation->paginate();
        return view('ceremony.create',compact('graduations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CeremonyRequest $request)
    {
        //
        $ceremony_valid= $this->ceremony->checkCeremony($request);
        if($ceremony_valid == true){
            if($ceremony = $this->ceremony->create($request->all())) {
                Toastr()->success('Ceremony Created Successfully','Success');
                return redirect()->route('ceremony.index');
    
            }
        } else {
            return redirect()->back();
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
        $ceremony = $this->ceremony->find($id);
        $graduations = $this->graduation->paginate();
        return view('ceremony.edit',compact('ceremony','graduations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CeremonyRequest $request, $id)
    {
        //
        if($this->ceremony->update($id,$request->all()))
        {
            Toastr()->success('Ceremony Updated Successfully','Success');
            return redirect()->route('ceremony.index');
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
        $ceremony = $this->ceremony->delete($id);
        return response()->json(['status'=>true]);
    }
}
