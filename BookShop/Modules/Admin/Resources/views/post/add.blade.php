@extends('admin::layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Post add</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('list.post') }}">Post</a></li>
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
        <form action="{{ route('post.store') }} " method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Tên bài viết</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Nhập tên bài viết...." value="{{ old('title') }}">
                    @if($errors->has('title'))
                    <div class="error-text">
                        {{$errors->first('title')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Mô tả bài viết</label>
                <div class="col-sm-9">
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="5" id="description" placeholder="Mô tả...." name="description">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                    <div class="error-text">
                        {{$errors->first('description')}}
                    </div>
                    @endif
                    </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Nội dung sản phẩm</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" id="content_post" placeholder="Nội dung...." name="content">{{ old('content') }}</textarea>
                    @if($errors->has('content'))
                    <div class="error-text">
                        {{$errors->first('content')}}
                    </div>
                    @endif
                </div>
            </div>
                
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Hình ảnh</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path" >
                    @if($errors->has('image_path'))
                    <div class="error-text">
                        {{$errors->first('image_path')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Từ khóa</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('keyword') is-invalid @enderror" name="keyword" placeholder="Nhập từ khóa...." value="{{ old('keyword') }}">

                    @if($errors->has('keyword'))
                    <div class="error-text">
                        {{$errors->first('keyword')}}
                    </div>
                    @endif
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
@section('js')

<script>
    CKEDITOR.replace('description', options);
    CKEDITOR.replace('content_post', options);
    
</script>
@endsection