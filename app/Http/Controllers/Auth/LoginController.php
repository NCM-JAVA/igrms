<?php

namespace App\Http\Controllers\Auth;
use App;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

   
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->generateSalt();
    }
    /**
     * Create a new controller instance.
     * New changes 
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {   
        $input = $request->all();

        $encryptedPassword = $request->input('password');
        $secretKey = "12345678901234567890123456789012"; // Must be 32 bytes
        $iv = "1234567890123456"; // Must be 16 bytes
        $pass = openssl_decrypt(
            base64_decode($encryptedPassword), // Decode from Base64
            "AES-256-CBC",
            $secretKey,
            OPENSSL_RAW_DATA,
            $iv
        );
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            'CaptchaCode'=>'required',
        ]);

        $user = User::where('email',$request->email)->first();
        if (!$user) {
            return redirect()->back()->with(['error' => 'User not found.']);
        }

        if($user->flag_id == 1){
            return redirect()->route('login')->with('error', 'You are already logged in on another device.');
        }
        
        $code = clean_single_input($request->input('CaptchaCode'));
        $isHuman = captcha_validate($code);
    
        if ($isHuman) {
            $email=clean_single_input($input['email']);
            // $data = Menu::where('email', $email)->first();
            //  $pass=clean_single_input($input['password']);
            // $binaryHash =   pack("H*", $pass);//hex2bin($pass);
           
           //  $plainText =$binaryHash;

            // Print the plain text
          //  echo "plainText".$plainText;
            // if($user->flag_id == 1){
            //     return redirect()->route('login')->with('error', 'You are already logged in on another device.');
            // }

            $decr_pw = strtoupper(hash("sha512", $pass));
          //  echo $oldpass=$data->password;
           // dd($plainText);
           $saltpass= strtoupper(hash("sha512", $pass . clean_single_input($input['BDC_VCID_ExampleCaptcha'])));
            if(auth()->attempt(array('email' => $email, 'password' => $pass)))
            {   
                $date=Carbon::now();

                User::where('email', $email)->update(['last_login_date' => $date, 'flag_id' => 1]);
                session()->put('admin_login', 1);

                if (auth()->user()->userType == 'admin') {
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('home');
                }
            }else{
            
                return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
            }
        } else {
            return redirect()->route('login')->with('error','Captcha Is Wrong.');
        }
          
    }
    public function generateSalt() {
		    $salt =uniqid(rand(59999, 199999));
		    App::setLocale($salt);
            session()->put('salt', $salt);
            return $salt;
       
    }

    public function logout(){     
        $user = Auth::user();
        if ($user) {
            $user->update(['flag_id' => 0]);
        }
        Auth::logout();
        Session::flush();
        return redirect()->route('login')->with('error', 'You are logged out successfully.');
    }
    
}
