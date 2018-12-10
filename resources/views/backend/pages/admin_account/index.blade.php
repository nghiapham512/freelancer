@extends('adminlte::page')



@section('title', 'Freelancer')



@section('content_header')

    <h1>Danh sách tài khoản Admin</h1>
    <div class="alert alert-danger" {{(($errors->first()==null))?'hidden':''}}>
        {{$errors->first()}}
    </div>
@stop



@section('content')

    <div class="box">
        <div class="box-header with-border">
            <span>Tổng số tài khoản </span><span class="badge badge-info">{{count($dataAdmin)}}</span>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Cấp admin</th>
                    @php($permission = \Auth::guard('admin')->user()->super_admin)
                    @if($permission==1)
                        <th class="text-center" width="10%"></th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($dataAdmin as $item)
                    <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td class="text-center">{{$item->username}}</td>
                        <td class="text-center">{{$item->email}}</td>
                        <td class="text-center">{{($item->super_admin==1)?"Superadministrator":"Administrator"}}</td>
                        @if($permission==1)
                            <td class="text-center">
                                @if($item->super_admin==0)
                                    <button type="button" class="btn btn-danger view-admin" data-username="{{$item->username}}" data-id="{{$item->id}}" data-toggle="modal" data-target="#modal-danger">
                                        Xóa tài khoản
                                    </button>
                                @endif
                            </td>
                        @endif
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
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    <h4 class="modal-title">Xóa tài khoản</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc muốn xóa tài khoản <span id='showusername'></span> không ?</p>
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
            window.location.href="http://localhost/freelancer/public/admin/admin_account/delete/"+$id;
        });
    </script>

@stop