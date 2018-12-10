<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CreateAdminRequest;
use App\Repositories\backend\Admin\AdminRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct(AdminRepositoryInterface $admin)
    {
        $this->admin = $admin;
    }

    public function index(){
        $dataAdmin = $this->admin->all();
        return view('backend.pages.admin_account.index', compact('dataAdmin'));
    }

    public function add(){
        return view('backend.pages.admin_account.add');
    }

    public function processAdd(CreateAdminRequest $request){
        $check = $this->admin->checkIfExist($request->username, $request->email);

        if ($check==0){
            return redirect()->back()->withErrors("Username đã được sử dụng!");
        }
        elseif($check==1){
            return redirect()->back()->withErrors("Email đã được sử dụng!");
        }
        else{
            if($this->admin->save($request->except('_token'))){
                return redirect()->route('admin.admin_account.index');
            }
            else{
                return redirect()->back()->withErrors('Tạo tài khoản thất bại!');
            }
        }
    }

    public function my_profile(){
        return view('backend.pages.my_profile.index');
    }

    public function delete($id){
        $delete = $this->admin->delete($id);
        if ($delete==true){
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors('Xóa tài khoản thất bại');
        }
    }
}
