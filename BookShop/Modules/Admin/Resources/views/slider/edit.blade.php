@extends('admin::layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Slider update</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('list.slider') }}">Slider</a></li>
            <li class="breadcrumb-item active">update</li>

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
        <form action="{{ route('slider.update', ['id' => $slider->id]) }} " method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                  <label for="" class="col-sm-3 col-form-label">Tên slider</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $slider->name }}">
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
                      <img src="{{ asset('public'.$slider->image_path) }}" width="400px">
                      @if($errors->has('image_path'))
                          <div class="error-text">
                              {{$errors->first('image_path')}}
                          </div>
                      @endif
                  </div>
              </div>
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Mô tả slider</label>
                  <div class="col-sm-9">
                      <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="5" placeholder="Mô tả slider...." name="description">{{ $slider->description }}</textarea>
                      @if($errors->has('description'))
                          <div class="error-text">
                              {{$errors->first('description')}}
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
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
                  </form>

    </div>
</div>
@endsection
