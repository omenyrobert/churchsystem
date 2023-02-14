<?php
namespace App\Http\Middleware;
use Closure;

class CheckAuth {
  public function handle($request, Closure $next){
    if(!auth()->check()){
      return response()->view('index');
    }else {
      return $next($request);
    }
  }
}