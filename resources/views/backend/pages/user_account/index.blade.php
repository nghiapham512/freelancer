@extends('adminlte::page')



@section('title', 'Freelancer')



@section('content_header')

    <h1>Danh sách tài khoản User</h1>
    <div class="alert alert-danger" {{(($errors->first()==null))?'hidden':''}}>
        {{$errors->first()}}
    </div>
@stop



@section('content')

    <div class="box">
        <div class="box-header with-border">
            <span>Tổng số tài khoản </span><span class="badge badge-info">{{count($dataUser)}}</span>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Tên đầy đủ</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Loại tài khoản</th>
                    <th class="text-center">Ví (VND)</th>
                    <th class="text-center">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataUser as $item)
                    <tr>
                        <td class="text-center" width="5%">{{$item->id}}</td>
                        <td class="text-center">{{$item->username}}</td>
                        <td class="text-center">{{$item->fullname}}</td>
                        <td class="text-center">{{$item->email}}</td>
                        <td class="text-center">{{($item->account_type==1)?"Nhà tuyển dụng":"Freelancer"}}</td>
                        <td class="text-center">{{$item->wallet}}</td>
                        <td class="text-center" width="5%">
                                <button type="button" class="btn {{($item->status==0)?"btn-success":"btn-defaul"}} view-admin" data-username="{{$item->username}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-danger">
                                    {{($item->status==0)?"Activate":"Deactivate"}}
                                </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-danger" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xóa tài khoản</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc muốn đôi trạng thái tài khoản <span id='showusername'></span> không ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default yes" id="valueid">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@stop



@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">

@stop



@section('js')

    <script>
        $(document).on("click", ".view-admin", function() {
            var adminid = $(this).data('id');
            var adminusername = $(this).data('username');
            $(".modal-footer #valueid").val(adminid);
            $(".modal-body #showusername").text(adminusername);
            $('#modal-danger').modal('show');
        });
        $(document).on("click", ".yes", function(){
            $id = document.getElementById("valueid").value;
            $("#modal-danger").modal('hide');
            window.location.href="http://localhost/freelancer/public/admin/user_account/change_status/"+$id;
        });
    </script>

@stop