<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function login(Request $request)
    {

        $arr = [
            'username' => $request->code,
            'password' => $request->password,
        ];

        if ($request->remember == 'on') {
            $remember = true;
        } else {
            $remember = false;
        }
        // dd($remember);
        //kiểm tra trường remember có được chọn hay không

        if (Auth::attempt($arr, $remember)) {
            return redirect()->route('forum');
        }
        if (Auth::guard('admin')->attempt($arr, $remember)) {
            return redirect()->route('club.admin');
        }
        else{
            return redirect()->back()->with('error','MSSV hoặc mật khẩu chưa chính xác')->withInput();
        }
    }
    public function logout()
    {
        if(Auth::guard('admin')->check()){

            Auth::guard('admin')->logout();
        }
        else{

            Auth::logout();
        }
        return redirect('/dang-nhap');
    }
    public function form_login()
    {
        if(Auth::check() || Auth::guard('admin')->check()){
            return redirect()->route('forum');
        }
        return view('login.login');
    }
}
