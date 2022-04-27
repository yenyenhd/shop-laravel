@extends('admin::layouts.master')
@section('title')
    <title>Contact</title>
@endsection
@section('css')
<style>

input[type="file"] {
    display: none;
}

</style>
@endsection
@section('content')
    <div class="content-header">
        <div class="row  mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <span class="ml-1">Contact</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
                    <li class="breadcrumb-item active">Contac</li>
                    
                </ol>
            </div>
        </div>
    </div>

        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <a href="{{ route('contact.add') }}" class="btn btn-success m-2"><i class="ti-plus"></i></a>
            </div>
        </div>
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
         @endif
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display" style="min-width: 845px" id="dataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thông tin liên hệ</th>
                                <th>Bản đồ</th>
                                <th>Logo</th>
                                <th>Slogan</th>
                                <th>Cập nhật</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contact as $con)
                            <tr>
                                <td>{{ $con->id }}</td>
                                <td>{!! $con->contact !!}</td>
                                <td width="50px" >{!! $con->map !!}</td>
                                <td><img src="{{ asset('public'.$con->logo) }}" width="300px"></td>
                                <td>{{ $con->slogan }}</td>
                                
                                <td>
                                    {{-- @can('banner edit') --}}
                                    <a style="color: blue; font-size: 20px; padding-right: 30px;" href="{{ route('contact.edit', $con->id) }}"><i class="ti-pencil-alt"></i></a>
                                    {{-- @endcan --}}
                            
                               </td>

                            </tr>
                           @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>



    <!-- /.container-fluid -->
@endsection




