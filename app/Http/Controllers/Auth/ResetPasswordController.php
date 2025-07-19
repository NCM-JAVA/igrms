<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function resetpassword(){
		
		$title = "Reset Password";
        return view('auth/passwords/resetadmin',compact(['title']));
     }
	 
	 public function updatePassword(Request $request){
        $request->validate([
             'Currunt_Password' => 'required',
             'New_Password' => ['required','min:8','regex:/^(?=.*[a-zA-Z0-9])(?=.*[!@#$%^&*(),.?":{}|<>]).+$/'],
             'confirm_password' => 'required|same:New_Password'
        ]);
        $messages = [
        'New_Password.required' => 'New Password is required.',
        'New_Password.min' => 'Password must be at least 8 characters.',
        'New_Password.regex' => 'Password must contain at least one alphanumeric and one special character.',
        'confirm_password.required' => 'Please confirm your password.',
        'confirm_password.same' => 'Confirmation does not match the new password.',
        ];
        $user = Auth::user();
		$currentPasswordStatus = Hash::check($request->Currunt_Password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->New_Password),
            ]);

            if ($user) {
                $user->update(['flag_id' => 0]);
            }
            Auth::logout();
            Session::flush();

            return redirect()->route('login')->with('success', 'Password changed successfully!');
        //    return redirect()->back()->with('success', 'Password changed successfully!');

        }else{

           return redirect()->back()->withErrors(['current_password' => 'Current Password does not match with Old Password']);
		  
        } 
    }
}
