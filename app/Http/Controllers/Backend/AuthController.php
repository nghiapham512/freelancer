<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminAccount;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        if (Auth::guard('admin')->check()){
            return redirect()->route('admin.projects.index');
        }
        else{
            return view('backend.pages.login');
        }
    }

    public function processLogin(LoginRequest $request){
        $dataRequest = $request->except('_token');
        $user = AdminAccount::where('username',$dataRequest['username'])->first();
//        dd($dataRequest);
        if (Auth::guard('admin')->attempt(['username' => $dataRequest['username'], 'password' => $dataRequest['password']])){
            $user->save();
            return redirect()->route('admin.projects.index');
        }
        else{
            return redirect()->back()->withErrors("Username hoặc mật khẩu không đúng")->withInput($request->all());
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('backend.auth.login');
    }
}
