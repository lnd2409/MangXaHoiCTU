<?php

namespace App\Http\Middleware;

use Closure;

class checkManage
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
        $club=\DB::table('clubs')->where('c_slug',$request->slug)->first('c_id');
        if($club){
            //kiểm tra phải admin không
            $admin=\DB::table('club_students')
            ->where('stu_id',\Auth::id())
            ->where('c_id',$club->c_id)
            ->whereNotIn('cs_role',['YC','TV'])->first();
            if($admin){

                return $next($request);
            }
            else{
                return redirect('404');
            }
        }
        return redirect('404');
    }
}
