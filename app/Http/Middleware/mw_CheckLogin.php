<?php 

namespace Candy\Http\Middleware;

use Closure;

class mw_CheckLogin
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
      // session_start();
      // if (empty($_SESSION['user_session'])) {
      //   return redirect('/');
      // }
      
      // return $next($request);
    }
}
