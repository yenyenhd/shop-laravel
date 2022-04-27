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
            <span class="ml-1">Contact</span>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contact</a></li>
            <li class="breadcrumb-item active">cập nhật thông tin</li>

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
        <form action="{{ route('contact.update', [ 'id' => $contact->id]) }} " method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Thông tin liên hệ</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" id="contact" placeholder="Thông tin liên hệ...." name="contact">{{ $contact->contact }}</textarea>
                </div>
            </div>
    
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Bản đồ</label>
                <div class="col-sm-9">
                    <textarea class="form-control" rows="5" id="map"  name="map">{!! $contact->map !!}</textarea> 
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Logo</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo" >
                    <img src="{{ asset('public'.$contact->logo) }}" width="400px">
                    @if($errors->has('logo'))
                        <div class="error-text">
                            {{$errors->first('logo')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Slogan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan" value="{{ $contact->slogan }}">
                    @if($errors->has('slogan'))
                    <div class="error-text">
                        {{$errors->first('slogan')}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-9">
                <button type="submit" name="add_info" class="btn btn-primary">Cập nhật thông tin</button>
              </div>
            </div>
        </form>

    </div>
</div>

@endsection
@section('js')
<script>
    CKEDITOR.replace('contact', options);
</script>

@endsection
