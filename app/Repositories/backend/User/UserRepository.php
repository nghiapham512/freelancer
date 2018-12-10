<?php
namespace  App\Repositories\backend\User;
use App\Models\UserAccount;
use App\User;


class UserRepository implements UserRepositoryInterface
{
    public function  all()
    {
        return UserAccount::all('id','username','fullname','email','account_type','wallet','skill_id','status');
    }

    public function change_status($id)
    {
        $user = UserAccount::find($id);

        if ($user){
            if ($user->status==1){
                $user->status = 0;
            }
            else{
                $user->status = 1;
            }
            return $change_status = $user->save();
        }
        else{
            return false;
        }
    }
}

?>