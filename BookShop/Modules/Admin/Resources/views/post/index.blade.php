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
            <span class="ml-1">Post</span>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('list.post') }}">Post</a></li>
            <li class="breadcrumb-item active">list</li>

        </ol>
    </div>
</div>
</div>
<div class="row page-titles mx-0">
     <div class="col-sm-6 p-md-0">
         <a href="{{ route('post.add') }}" class="btn btn-success m-2"><i class="ti-plus"></i></a>
    </div>
    <div class="col-sm-6 p-md-0  mt-2 mt-sm-0 float-right">
        <form action="{{route('post.import_csv')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <label for="" class="col-sm-3 col-form-label">Import CSV</label> --}}
            <div class="d-flex p-md-0 justify-content-end mt-2 mt-sm-0">
                 <label class="btn btn-info mr-sm-1" > Chọn file
                <input type="file" name="file" accept=".xlsx" >
            </label>
            <input type="submit" value="Import CSV" name="import_csv" class="btn btn-primary">
            </div>

    </form>
    <form action="{{route('post.export_csv')}}" method="POST" style="margin-top: 5px;">
            @csrf
            <div class="d-flex p-md-0 justify-content-end mt-15 mt-sm-0">
            <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
        </div>
        </form>
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
                        <th>Tên bài viết</th>
                        <th>Hình ảnh</th>
                        <th>Mô tả</th>
                        <th>Hiển thị</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ asset('public'.$post->image_path) }}" width="200px"></td>
                        <td>{!! $post->description !!} </td>
                        <td>
                            <a href="{{ route('post.action', ['active',$post->id]) }}" class="badge badge-pill {{ $post->getStatus($post->active)['class'] }}">{{ $post->getStatus($post->active)['name'] }}</a>
                        </td>
                        <td>
                            {{-- @can('slider edit') --}}
                            <a style="color: blue; font-size: 20px; padding-right: 30px;" href="{{ route('post.edit', $post->id) }}"><i class="ti-pencil-alt"></i></a>
                            {{-- @endcan --}}
                            {{-- @can('slider delete') --}}
                            <a style="color: red; font-size: 20px;" href="" data-url="{{ route('post.action', ['delete',$post->id]) }}" class="action-delete"><i class="ti-trash"></i></a>
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
