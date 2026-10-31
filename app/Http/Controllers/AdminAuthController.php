<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AdminAuthController extends Controller
{
    public function logout(Request $request) { Auth::logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect()->route('login'); }
    public function forgot() { return view('auth.forgot-password'); }
    public function sendReset(Request $request) {
        $data=$request->validate(['email'=>'required|email:rfc|max:254']);
        if(User::where('email',$data['email'])->where('is_admin',true)->exists())Password::sendResetLink($data);
        return back()->with('status','If this email belongs to a GREI staff account, a password reset link has been sent.');
    }
    public function reset(Request $request,string $token) { return view('auth.reset-password',['token'=>$token,'email'=>is_string($request->query('email'))?$request->query('email'):'']); }
    public function updatePassword(Request $request) {
        $data=$request->validate(['token'=>'required|string','email'=>'required|email:rfc','password'=>['required','confirmed',PasswordRule::min(12)->mixedCase()->numbers()->symbols()]]);
        if(!User::where('email',$data['email'])->where('is_admin',true)->exists())return back()->withErrors(['email'=>'This reset link could not be verified.']);
        $status=Password::reset($data,function(User $user,string $password){$user->forceFill(['password'=>$password,'remember_token'=>Str::random(60)])->save();event(new PasswordReset($user));});
        return $status===Password::PASSWORD_RESET?redirect()->route('login')->with('status',__($status)):back()->withErrors(['email'=>__($status)]);
    }
}
