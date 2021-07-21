<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;

class ResetPasswordController extends Controller
{
	public function reset(Request $request){
		$request->validate([
			'email' => 'required|email|exists:partners',
		]);

		$token = \Str::random(64);

		\DB::table('password_resets')->insert(
			[
				'email' => $request->email,
				'token' => $token,
				'created_at' => date('Y-m-d H:i:s')
			]
		);

		\Mail::send('auth.verify_password', ['token' => $token], function($message) use($request){
			$message->to($request->email);
			$message->subject('Reset Password Notification');
		});

		return back()->with('status', 'Berhasil mengirim email ganti password.');
	}  

	public function getPassword($token) { 
		return view('auth.partners.passwords_reset', ['token' => $token]);
	}

	public function updatePassword(Request $request){
		$request->validate([
			'email' => 'required|email|exists:partners',
			'password' => 'required|string|min:6|confirmed',
			'password_confirmation' => 'required',

		]);

		$updatePassword = \DB::table('password_resets')
		->where(['email' => $request->email, 'token' => $request->token])
		->first();

		if(!$updatePassword)
			return back()->withInput()->with('error', 'Invalid token!');

		$partner = Partner::where('email', $request->email)->first();
		$partner->password = \Hash::make($request->password);
		$partner->is_verified_by_admin = $partner->is_verified_by_admin;
		$partner->save();

		\DB::table('password_resets')->where(['email'=> $request->email])->delete();

		return redirect('/partner/login')->with('status', 'Berhasil mengubah password !');
	}
}
