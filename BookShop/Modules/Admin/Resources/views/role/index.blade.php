@extends('admin::layouts.master')

@section('css')
<style>

input[type="file"] {
    display: none;
}

</style>
@endsection
@section('content')
<div class="content-header">

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Hi, welcome back!</h4>
            <span class="ml-1">Role</span>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('list.role') }}">Role</a></li>
            <li class="breadcrumb-item active">list</li>

        </ol>
    </div>
</div>
</div>
<div class="row page-titles mx-0">
     <div class="col-sm-6 p-md-0">
         <a href="{{ route('role.add') }}" class="btn btn-success m-2"><i class="ti-plus"></i></a>
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
            <table id="dataTable" class="display" style="min-width: 845px">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Guard name</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            {{-- @can('slider edit') --}}
                            <a style="color: blue; font-size: 20px; padding-right: 30px;" href="{{ route('role.edit', $role->id) }}"><i class="ti-pencil-alt"></i></a>
                            {{-- @endcan --}}
                            {{-- @can('slider delete') --}}
                            <a style="color: red; font-size: 20px;" href="" data-url="{{ route('role.destroy', $role->id) }}" class="action-delete"><i class="ti-trash"></i></a>
                            {{--  @endcan --}}
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
