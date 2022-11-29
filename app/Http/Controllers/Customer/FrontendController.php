<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Modules\Models\CustomerCeremony\CustomerCeremony;
use App\Modules\Models\Order\Order;
use App\Modules\Service\Ceremony\CeremonyService;
use App\Modules\Service\Graduation\GraduationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    protected $graduation, $ceremony;

    function __construct(GraduationService $graduation, CeremonyService $ceremony, CustomerCeremony $customerceremony, Order $order)
    {
        $this->graduation = $graduation;
        $this->ceremony = $ceremony;
        $this->customerceremony = $customerceremony;
        $this->order = $order;
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
            $orderData['student_id'] = $request->student_id;
            $orderData['package_id'] = 1;
            $order =  $this->order->create($orderData);
            Toastr()->success('Ceremony Selected Successfully','Success');
            return redirect()->route('customer.orderSummary',compact('order'));
        }
    }

    public function orderSummary(Request $request) 
    {   
        $order = $request->all();
        return view('customer.qrcode',compact('order'));
    }

    public function updateCheckIn($id) {
        $order = $this->order->where('id', $id);
        if($order->first()->checkedIn_status == "returned") {
            $todeliver_msg = "User have already returned the dress.The Ticket is invalid";
            return redirect()->back()->withSuccess(trans($todeliver_msg));
        } else {
            $order->update([
                'count' => $order->first()->count + 1,
            ]);
            if($order->first()->count == 1) {
                $order->update([
                    'checkedIn_status' => 'arrived',
                ]);
                $todeliver_msg = "User have arrived at the ceremony";
            } elseif($order->first()->count == 2) {
                $order->update([
                    'checkedIn_status' => 'collected',
                ]);
                $todeliver_msg = "User have collected the dress";
            } elseif($order->first()->count == 3) {
                $order->update([
                    'checkedIn_status' => 'returned',
                ]);
                $todeliver_msg = "User have returned the dress";
            }
        }
        
        return redirect()->back()->withSuccess(trans($todeliver_msg));


    }

}
