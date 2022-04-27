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
                <span class="ml-1">Product</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('list.product') }}">Product</a></li>
                <li class="breadcrumb-item active">list</li>

            </ol>
        </div>

    </div>
</div>

<div class="row page-titles mx-0">
     <div class="col-sm-6 p-md-0">
         <a href="{{ route('product.add') }}" class="btn btn-success m-2"><i class="ti-plus"></i></a>
    </div>
    <div class="col-sm-6 p-md-0  mt-2 mt-sm-0 float-right">
        <form action="{{route('product.import_csv')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <label for="" class="col-sm-3 col-form-label">Import CSV</label> --}}
            <div class="d-flex p-md-0 justify-content-end mt-2 mt-sm-0">
                 <label class="btn btn-info mr-sm-1" > Chọn file
                <input type="file" name="file" accept=".xlsx" >
            </label>
            <input type="submit" value="Import CSV" name="import_csv" class="btn btn-primary">
            </div>

    </form>
    <form action="{{route('product.export_csv')}}" method="POST" style="margin-top: 5px;">
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
                <table id="dataTable" class="display" style="min-width: 845px" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Loại sản phẩm</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                            <th>Nổi bật</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset('public'.$product->avatar_path) }}" width="200px"></td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ number_format($product->price,0,',','.') }} vnd</td>
                            <td>
                                <a href="{{ route('product.action', ['active',$product->id]) }}" class="badge badge-pill {{ $product->getStatus($product->active)['class'] }}">{{ $product->getStatus($product->active)['name'] }}</a>
                            </td>
                            <td>
                                <a href="{{ route('product.action', ['product_hot', $product->id]) }}" class="badge badge-pill {{ $product->getHot($product->hot)['class'] }}">{{ $product->getHot($product->hot)['name'] }}</a>
                              </td>
                           <td>
                                {{-- @can('product edit') --}}
                                <a style="color: blue; font-size: 20px; padding-right: 30px;" href="{{ route('product.edit', $product->id) }}"><i class="ti-pencil-alt"></i></a>
                                {{-- @endcan --}}
                                {{-- @can('product delete') --}}
                                <a style="color: red; font-size: 20px;" href="" data-url="{{ route('product.action', ['delete',$product->id]) }}" class="action-delete"><i class="ti-trash"></i></a>
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

