<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdmin extends Command
{
    protected $signature='grei:admin {email?} {--name=} {--reset-password : Reset an existing administrator password}';
    protected $description='Create a GREI administrator without public registration or default credentials';
    public function handle():int {
        $email=$this->argument('email') ?: $this->ask('Staff email');
        $name=$this->option('name') ?: $this->ask('Name');
        $existing=User::where('email',$email)->first();
        if($existing&&!$this->option('reset-password')){$this->error('This account already exists. Use --reset-password only when you intend to replace its password.');return self::FAILURE;}
        if($existing&&!$existing->is_admin){$this->error('This address belongs to a non-administrator. Use a separate staff address.');return self::FAILURE;}
        $password=getenv('GREI_ADMIN_PASSWORD') ?: $this->secret('Choose a password (12+ characters; mixed case, number and symbol)');
        $validator=Validator::make(compact('name','email','password'),['name'=>'required|string|max:100','email'=>'required|email:rfc|max:254','password'=>['required',Password::min(12)->mixedCase()->numbers()->symbols()]]);
        if($validator->fails()){foreach($validator->errors()->all() as $message)$this->error($message);return self::FAILURE;}
        $user=$existing??new User();$user->forceFill(['name'=>$name,'email'=>strtolower($email),'password'=>$password,'is_admin'=>true,'email_verified_at'=>now()])->save();
        $this->info('GREI administrator ready. Sign in at '.route('login'));return self::SUCCESS;
    }
}
