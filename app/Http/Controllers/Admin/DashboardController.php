<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('backend.modules.dashboard');
    }
   
   //User password change

    public function PasswordChange(){
        return view('auth.password_change');
    }

    //password Update
    public function PasswordUpdate(Request $request)
    {
        $validated = $request->validate([
           'old_password' => 'required',
           'password' => 'required|min:6|confirmed',
        ]);

        $current_password=Auth::user()->password;  //login user password get
        
        $oldpass=$request->old_password;  //oldpassword get from input field
        $new_password=$request->password;  // newpassword get for new password
        if (Hash::check($oldpass,$current_password)) {  //checking oldpassword and currentuser password same or not
               $user=User::findorfail(Auth::id());    //current user data get
               $user->password=Hash::make($request->password); //current user password hasing
               $user->save();  //finally save the password
               Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
               toastr()->success('Your Password Changed!', 'success');
               return redirect()->route('login');
        }else{
            toastr()->error('Old Password Not Matched!','error');
            return redirect()->back();
        }
    }
}
