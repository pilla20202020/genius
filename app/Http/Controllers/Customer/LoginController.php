<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Modules\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('customer.login.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required|',
            'password' => 'required',
        ]);
        $customer = Customer::where('student_id',$request->student_id)->first();
        if(isset($customer)) {
            $credentials = $request->only('student_id', 'password');
            $authenticate = Auth::guard('customer')->attempt($credentials);
            if($authenticate){
                return redirect()->route('customer.dashboard');
            }else{
                Toastr()->error('Student ID and Password did not match','Error');
                return redirect()->back();
            }
            
        } else {
            Toastr()->error('User Not Found','Error');
            return redirect()->back();
        }

    }

    public function student_id()
    {
        return 'student_id';
    }
    
}
