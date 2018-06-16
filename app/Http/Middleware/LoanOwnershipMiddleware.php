<?php

namespace App\Http\Middleware;
use App\Loan;
use Illuminate\Support\Facades\Auth;

use Closure;

class LoanOwnershipMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $id =  $request->segment(2);
    $loan = Loan::findOrFail($id);
    if($loan->user_id !== Auth::id()) {
      return redirect('/dashboard');
    }
    return $next($request);
  }
}
