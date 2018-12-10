@extends('adminlte::page')



@section('title', 'Freelancer')



@section('content_header')

    <h1>My Profile</h1>

@stop



@section('content')

    <div class="box box-primary">
        <div class="box-body">
            <ul class="list-group">
                <li class="list-group-item">ID : {{\Auth::guard('admin')->user()->id}}</li>
                <li class="list-group-item">Username : {{\Auth::guard('admin')->user()->username}}</li>
                <li class="list-group-item">Email : {{\Auth::guard('admin')->user()->email}}</li>
                <li class="list-group-item">Cấp admin : {{(\Auth::guard('admin')->user()->super_admin==1)?"Superadmin":"Admin"}}</li>
            </ul>
        </div>
    </div>

@stop



@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop



@section('js')



@stop