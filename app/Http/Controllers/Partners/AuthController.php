<?php

namespace App\Http\Controllers\Partners;

use Illuminate\Support\Facades\Auth;
use App\Models\Partner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Laravel\Fortify\Rules\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');;

        $user = \DB::table('partners')->where('email', $request->email)->value('is_verified_by_admin');
        if ($user > 0) {
            if (Auth::guard('partner')->attempt($credentials)) {
                return redirect()->route('partner.dashboard');
            }else{
                return redirect()->route('partner.login')->with(['error' => 'Email or password not valid!']);
            }
        }else{
            return redirect()->route('partner.login')->with(['error' => 'Account partner is not verified by admin.']);
        }
    }

    public function loginForm()
    {
        return view('auth.partners.login-partner');
    }

    public function register(Request $request)
    {
        Validator::make($request->input(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $partner = Partner::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if(!$partner) {
            return redirect()->route('partner.register');
        }

        return redirect()->route('partner.login');
    }

    public function registerForm()
    {
        return view('auth.partners.register-partner');
    }

    public function logout(Request $request)
    {
        Auth::guard('partner')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
