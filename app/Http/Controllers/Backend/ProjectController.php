<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
//        $dataUsers = $this->user->all();
        return view('backend.pages.projects.project_list', compact('dataUsers'));
    }
}
