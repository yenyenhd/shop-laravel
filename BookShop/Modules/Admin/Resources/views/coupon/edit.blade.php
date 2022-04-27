@extends('admin::layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Coupon update</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('list.coupon') }}">Coupon</a></li>
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
        <form action="{{ route('coupon.update', ['id' => $coupon->id]) }} " method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Tên mã giảm giá</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên coupon...." value="{{ $coupon->name }}">
                    @if($errors->has('name'))
                        <div class="error-text">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Mã giảm giá</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $coupon->code }}">
                  @if($errors->has('code'))
                      <div class="error-text">
                          {{$errors->first('code')}}
                      </div>
                  @endif
              </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Số lượng</label>
            <div class="col-sm-9">
                <input type="text" class="form-control @error('number') is-invalid @enderror" name="number"  value="{{ $coupon->number }}">
                @if($errors->has('number'))
                    <div class="error-text">
                        {{$errors->first('number')}}
                    </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-3 col-form-label">Tính năng mã</label>
          <div class="col-sm-9">
            <select class="form-control" name="condition">
              <option value="0">---Chọn---</option>
              <option value="1">Giảm theo phần trăm</option>
              <option value="2">Giảm theo tiền</option>
          </select>
              @if($errors->has('name'))
                  <div class="error-text">
                      {{$errors->first('name')}}
                  </div>
              @endif
          </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label">Số % hoặc tiền giảm</label>
        <div class="col-sm-9">
            <input type="number" class="form-control @error('sale') is-invalid @enderror" name="sale" value="{{ $coupon->sale }}">
            @if($errors->has('sale'))
                <div class="error-text">
                    {{$errors->first('sale')}}
                </div>
            @endif
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
