<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class ScalarQueryParameters {
    public function handle(Request $request,Closure $next){foreach($request->query() as $value)abort_if(is_array($value)||(!is_scalar($value)&&$value!==null),400,'Search parameters must be single values.');return $next($request);}
}
