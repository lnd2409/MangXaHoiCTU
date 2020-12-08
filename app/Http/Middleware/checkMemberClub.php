<?php

namespace App\Http\Middleware;

use Closure;

class checkMemberClub
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
        // $club=\DB::table('clubs')->where('c_slug',$request->slug)->first('c_id');
        // if($club){
        //     return $next($request);
        // }
        // return redirect('404');
        return $next($request);
    }
}
