<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class UserAccount extends User
{
    protected $table = "user_account";
}
