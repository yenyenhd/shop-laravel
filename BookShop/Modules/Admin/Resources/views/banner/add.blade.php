@extends('admin::layouts.master')

@section('content')
    <div class="content-header">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Banner add</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.banner') }}">Banner</a></li>
                    <li class="breadcrumb-item active">create</li>

                </ol>
            </div>
        </div>
    </div>
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
     @endif

        <div class="row mt-4">
            <div class="col-md-9">
                <form action="{{ route('banner.store') }} " method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Tên banner</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên banner...." value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <div class="error-text">
                                    {{$errors->first('name')}}
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
                      <div class="col-sm-3">Nổi bật</div>
                      <div class="col-sm-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck1" name="status">
                          <label class="form-check-label" for="gridCheck1">
                            Nổi bật
                          </label>
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
