<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Login;
use App\Models\User;
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

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try{
            $google_user = Socialite::driver('google')->user();

            $user = User::where('social_id',$google_user->getId())->first();
            if(!$user){
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'social_id' => (string) $google_user->getId(),
                    'social_type' => '1'
    
                ]);

                Auth::login($new_user);

                return redirect()->route('home');
            }
            else{
                Auth::login($user);

                return redirect()->route('home');
            }

        } catch (\Throwable $th){
            dd('Something went wrong! '.$th->getMessage() );
            //throw $th
    
        }
    }

    public function redirect_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(){
        try{
            $facebook_user = Socialite::driver('facebook')->user();

            $user = User::where('social_id',$facebook_user->getId())->first();
            if(!$user){
                $new_user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'social_id' => (string) $facebook_user->getId(),
                    'social_type' => '2'
    
                ]);

                Auth::login($new_user);

                return redirect()->route('home');
            }
            else{
                Auth::login($user);

                return redirect()->route('home');
            }

        } catch (\Throwable $th){
            dd('Something went wrong! '.$th->getMessage() );
            //throw $th
    
        }
    }
}
