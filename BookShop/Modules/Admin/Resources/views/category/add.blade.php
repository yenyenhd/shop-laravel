@extends('admin::layouts.master')

@section('content')

<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Category add</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('list.category') }}">Category</a></li>
            <li class="breadcrumb-item active">create</li>

        </ol>
    </div>
</div>
 @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
 @endif
<div class="row mt-4">

    <div class="col-md-9">
        <form action="{{ route('category.store') }} " method="POST">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Tên danh mục</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên danh mục...." value="{{ old('name') }}">
                    @if($errors->has('name'))
                    <div class="error-text">
                        {{$errors->first('name')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword3" class="col-sm-3 col-form-label">Chọn danh mục cha</label>
              <div class="col-sm-9">
                <select class="form-control" name="parent_id">
                    <option value="0">Chọn danh mục cha</option>
                    {{!!$htmlOption!!}}

                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Mô tả danh mục</label>
            <div class="col-sm-9">
                <textarea class="form-control" rows="5" id="description" placeholder="Mô tả danh mục...." name="description">{{ old('description') }}</textarea>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Từ khóa</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('keyword') is-invalid @enderror" name="keyword" value="{{ old('keyword') }}">
                @if($errors->has('keyword'))
                <div class="error-text">
                    {{$errors->first('keyword')}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
  <div class="col-sm-9">
    <button type="submit" class="btn btn-primary">Thêm</button>
</div>
</div>
</form>

</div>
</div>

@endsection
