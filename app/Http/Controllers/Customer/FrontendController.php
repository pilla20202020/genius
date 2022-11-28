<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Modules\Models\CustomerCeremony\CustomerCeremony;
use App\Modules\Service\Ceremony\CeremonyService;
use App\Modules\Service\Graduation\GraduationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    protected $graduation, $ceremony;

    function __construct(GraduationService $graduation, CeremonyService $ceremony, CustomerCeremony $customerceremony)
    {
        $this->graduation = $graduation;
        $this->ceremony = $ceremony;
        $this->customerceremony = $customerceremony;
    }
    //

    public function index() {
        $graduation_id = Auth::guard('customer')->user()->graduation_id;
        $graduation = $this->graduation->find($graduation_id);
        $student_id =  Auth::guard('customer')->user()->id;
        return view('customer.ceremony.login',compact('graduation','student_id'));
        
    }

    public function fetchCeremonyData(Request $request)
    {
        if($ceremony = $this->ceremony->find($request->ceremony_id))
        {
            return response()->json([
                'data' => $ceremony,
                'status' => true,
                'message' => "Ceremony Generated Successfully."
            ]);
        }
        ;

    }

    public function addCeremony(Request $request)
    {
        
        if($customerceremony = $this->customerceremony->create($request->except('_token'))){
            Toastr()->success('Ceremony Selected Successfully','Success');
            return redirect()->route('ceremony.index');
        }
    }
}
