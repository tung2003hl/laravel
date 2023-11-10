<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Login;
use App\Models\Social;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

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
    }

    public function login(Request $request)
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'seller') {
                return redirect()->route('seller.home');
            }else if (auth()->user()->type == 'shipper') {
                return redirect()->route('shipper.home');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
        
          
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
    
        return redirect()->route('login'); // Redirect to the login route
    }

    public function login_google(){
        return Socialite::driver('google')->redirect();
        }
        public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_login',$account_name->admin_name);
        Session::put('admin_id&',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        
        }
        public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){
        
        return $authUser;
        }
        
        $tung = new Social([
        'provider_user_id' => $users->id,
        'provider' => strtoupper($provider)
        
        ]);
        
        $orang = Login::where('admin_email&',$users->email)->first();
        
        if(!$orang){
        $orang = Login::create([
        'admin_name' => $users->name,
        'admin_email' => $users->email,
        'admin_password' => '',
        
        'admin_phone' => '',
        'admin_status' => 1
        ]);
        }
        $tung->login()->associate($orang);
        $tung->save();
        
        $account_name = Login::where('admin_id',$authUser->user)->first();
        Session::put('admin_login',$account_name->admin_name);
        Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        
        }
}
