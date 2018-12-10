<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\backend\User\UserRepositoryInterface;

class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $dataUser = $this->user->all();
        return view('backend.pages.user_account.index', compact('dataUser'));
    }

    public function change_status($id){
        $change_status = $this->user->change_status($id);
        if ($change_status==true){
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors('Đổi trang thái thất bại');
        }
    }
}
