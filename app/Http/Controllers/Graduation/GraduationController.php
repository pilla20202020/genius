<?php

namespace App\Http\Controllers\Graduation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Graduation\GraduationRequest;
use App\Modules\Service\Ceremony\CeremonyService;
use App\Modules\Service\Graduation\GraduationService;
use App\Modules\Service\Institution\InstitutionService;
use Illuminate\Http\Request;

class GraduationController extends Controller
{
    protected $graduation, $ceremony, $institution;

    function __construct(GraduationService $graduation, InstitutionService $institution, CeremonyService $ceremony)
    {
        $this->graduation = $graduation;
        $this->institution = $institution;
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
        $graduation = $this->graduation->paginate();
        return view('graduation.index',compact('graduation'));
    }

    public function getAllData()
    {
        // dd($this->role);
        return $this->graduation->getAllData();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $institutions = $this->institution->paginate();
        return view('graduation.create',compact('institutions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GraduationRequest $request)
    {
        //
        if($graduation = $this->graduation->create($request->all())) {
            Toastr()->success('Graduation Created Successfully','Success');
            return redirect()->route('graduation.index');

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
        $graduation = $this->graduation->find($id);
        $institutions = $this->institution->paginate();
        return view('graduation.edit',compact('graduation','institutions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GraduationRequest $request, $id)
    {
        //
        if($this->graduation->update($id,$request->all()))
        {
            Toastr()->success('Graduation Updated Successfully','Success');
            return redirect()->route('graduation.index');
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
        $graduation = $this->graduation->delete($id);
        return response()->json(['status'=>true]);
    }


    public function addCeremonyTime(Request $request) {
        $ceremony_valid= $this->ceremony->checkCeremony($request);
        if($ceremony_valid == true){
            if($ceremony = $this->ceremony->create($request->all())) {
                Toastr()->success('Ceremony Created Successfully','Success');
                return redirect()->route('graduation.index');
    
            }
        } else {
            return redirect()->back();
        }
    }

    public function viewCeremony(Request $request) {
        if($ceremony = $this->ceremony->findByGraduationId($request->graduation_id))
        {
            return response()->json([
                'data' => $ceremony,
                'status' => true,
                'message' => "Ceremony Generated Successfully."
            ]);
        }
    }
}
