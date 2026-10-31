<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SpaceController;
use App\Http\Middleware\ScalarQueryParameters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/',HomeController::class)->name('home');
Route::middleware(ScalarQueryParameters::class)->group(function(){
    Route::livewire('/properties','pages::property-index')->name('properties.index');
    Route::livewire('/stays','pages::stay-index')->name('stays.index');
    Route::livewire('/design/projects','pages::project-index')->name('projects.index');
    Route::get('/contact',ContactController::class)->name('contact');
});
Route::get('/properties/{listing:slug}',[SpaceController::class,'property'])->name('properties.show');
Route::get('/stays/{listing:slug}',[SpaceController::class,'stay'])->name('stays.show');
Route::get('/stays/{listing:slug}/availability',[SpaceController::class,'availability'])->middleware('throttle:availability')->name('stays.availability');
Route::get('/design',[DesignController::class,'index'])->name('design');
Route::get('/design/consultation',function(Request $request){$type=$request->query('type');return view('pages.consultation',['designType'=>is_string($type)&&array_key_exists($type,config('grei.design_services'))?$type:null]);})->name('design.consultation');
Route::get('/design/services/{service}',[DesignController::class,'service'])->name('design.service');
Route::get('/design/projects/{project:slug}',[SpaceController::class,'project'])->name('projects.show');
Route::view('/about','pages.about')->name('about');
Route::get('/privacy',fn()=>view('pages.policy',['heading'=>'Privacy notice','settingKey'=>'privacy_text','defaultText'=>config('grei.default_privacy')]))->name('privacy');
Route::get('/terms',fn()=>view('pages.policy',['heading'=>'Website terms','settingKey'=>'terms_text','defaultText'=>config('grei.default_terms')]))->name('terms');
Route::post('/enquiries',EnquiryController::class)->middleware('throttle:enquiries')->name('enquiries.store');
Route::get('/media/{media}',MediaController::class)->name('media.show');

Route::middleware('guest')->group(function(){
    Route::livewire('/admin/login','admin::login')->name('login');
    Route::get('/admin/forgot-password',[AdminAuthController::class,'forgot'])->name('password.request');
    Route::post('/admin/forgot-password',[AdminAuthController::class,'sendReset'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/admin/reset-password/{token}',[AdminAuthController::class,'reset'])->name('password.reset');
    Route::post('/admin/reset-password',[AdminAuthController::class,'updatePassword'])->middleware('throttle:5,1')->name('password.update');
});
Route::prefix('admin')->middleware(['auth','can:access-admin'])->name('admin.')->group(function(){
    Route::livewire('/','admin::dashboard')->name('dashboard');
    Route::livewire('/listings','admin::listings')->name('listings');
    Route::livewire('/listings/create','admin::listing-editor')->name('listings.create');
    Route::livewire('/listings/{slug}/edit','admin::listing-editor')->name('listings.edit');
    Route::livewire('/projects','admin::projects')->name('projects');
    Route::livewire('/projects/create','admin::project-editor')->name('projects.create');
    Route::livewire('/projects/{slug}/edit','admin::project-editor')->name('projects.edit');
    Route::livewire('/enquiries','admin::enquiries')->name('enquiries');
    Route::livewire('/enquiries/{enquiry}','admin::enquiry-show')->name('enquiries.show');
    Route::livewire('/settings','admin::settings')->name('settings');
    Route::post('/logout',[AdminAuthController::class,'logout'])->name('logout');
});
