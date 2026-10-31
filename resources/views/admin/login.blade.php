<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component {
    public string $email='';public string $password='';public bool $remember=false;
    public function login(){
        $this->validate(['email'=>'required|email:rfc|max:254','password'=>'required|string|max:200']);
        $key='grei-login:'.Str::transliterate(Str::lower($this->email).'|'.request()->ip());
        if(RateLimiter::tooManyAttempts($key,5)){$this->addError('email','Please wait '.RateLimiter::availableIn($key).' seconds before trying again.');return;}
        if(!Auth::attempt(['email'=>$this->email,'password'=>$this->password,'is_admin'=>true],$this->remember)){RateLimiter::hit($key,60);$this->password='';$this->addError('email','Those sign-in details could not be verified.');return;}
        RateLimiter::clear($key);request()->session()->regenerate();$this->password='';return redirect()->intended(route('admin.dashboard'));
    }
};
?>
<div class="auth-form-wrap"><p class="eyebrow">Welcome back.</p><h2>Behind the<br>considered details.</h2><p>Sign in to manage the GREI website.</p>@if(session('status'))<p class="admin-flash" role="status">{{ session('status') }}</p>@endif<form wire:submit="login" class="public-enquiry-form"><label>Email address<input type="email" wire:model="email" autocomplete="username" required>@error('email')<span class="field-error" role="alert">{{ $message }}</span>@enderror</label><label>Password<input type="password" wire:model="password" autocomplete="current-password" required>@error('password')<span class="field-error">{{ $message }}</span>@enderror</label><div class="auth-options"><label class="consent-label"><input type="checkbox" wire:model="remember"><span>Remember me</span></label><a href="{{ route('password.request') }}">Forgot password?</a></div><button type="submit" class="solid-button" wire:loading.attr="disabled"><span wire:loading.remove wire:target="login">Sign in</span><span wire:loading wire:target="login">Signing in…</span><x-grei.icon /></button></form><a class="text-link" href="{{ route('home') }}">← Back to GREI</a></div>
