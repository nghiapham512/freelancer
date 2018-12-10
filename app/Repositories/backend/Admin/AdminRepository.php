<?php
namespace  App\Repositories\backend\Admin;
use App\Models\AdminAccount;
//use App\Repositories\backend\Admin\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function  all()
    {
        return AdminAccount::all('id','username','email','super_admin');
    }

    public function  save($data)
    {
        $admin = new AdminAccount();
        $admin->username = $data['username'];
        $admin->email = $data['email'];
        $admin->password = bcrypt($data['password']);
        $admin->super_admin = 0;

        return $admin->save();
    }

    public function delete($id)
    {
        return $delete = AdminAccount::where('id',$id)->delete();
    }

    public function checkIfExist($username, $email)
    {
        $username = AdminAccount::where('username',$username)->get();
        $email = AdminAccount::where('email', $email)->get();
        if (isset($username[0])){
            return 0;
        }elseif (isset($email[0])){
            return 1;
        }
        else{
            return 2;
        }
    }
}

?>