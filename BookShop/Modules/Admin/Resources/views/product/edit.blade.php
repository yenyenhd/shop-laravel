@extends('admin::layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Product update</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('list.product') }}">Product</a></li>
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
      <form action=" {{ route('product.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
      
          <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Tên sản phẩm</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên sản phẩm...." value="{{ $product->name }}">
                  @if($errors->has('name'))
                  <div class="error-text">
                      {{$errors->first('name')}}
                  </div>
                  @endif
              </div>
          </div>
          <div class="form-group row">
              <label for="" class="col-sm-3 col-form-label">Mô tả sản phẩm</label>
              <div class="col-sm-9">
                  <textarea class="form-control @error('description') is-invalid @enderror" rows="5" id="description" placeholder="Mô tả...." name="description">{!! $product->description !!}</textarea>
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
                  <textarea class="form-control" rows="5" id="content_product" placeholder="Nội dung...." name="content">{!! $product->content !!}</textarea>
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
                <input type="file" class="form-control-file @error('avatar_path') is-invalid @enderror" name="avatar_path" >
                <div class="col-sm-4">
                  <div class="row">
                      <img class="avatar_image" src="{{ asset('public'.$product->avatar_path) }}" width="200px" alt="">
                  </div>
              </div>
                @if($errors->has('avatar_path'))
                <div class="error-text">
                    {{$errors->first('avatar_path')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-3 col-form-label">Thư viện ảnh</label>
          <div class="col-sm-9">
              <input type="file" multiple class="form-control-file" name="image_path[]" >
              <div class="col-sm-9">
                <div class="row">
                  @foreach($product->productImages as $imageItem)
                  <div class="col-md-3">
                      <img class="image_detail_product" src="{{ asset('public'.$imageItem->image_path) }}" alt="" width="100pxs">
                  </div>
                  @endforeach
                </div>
            </div>
          </div>
      </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-3 col-form-label">Loại sản phẩm</label>
            <div class="col-sm-9">
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                    <option value="0">Chọn loại sản phẩm</option>
                    {{!!$htmlOption!!}}
                  
                </select>
                @if($errors->has('category_id'))
                <div class="error-text">
                    {{$errors->first('category_id')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Số lượng</label>
            <div class="col-sm-9">
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Nhập số lượng...." value="{{ $product->quantity }}">
                @if($errors->has('quantity'))
                <div class="error-text">
                    {{$errors->first('quantity')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Giá sản phẩm</label>
            <div class="col-sm-9">
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Nhập giá...." value="{{ $product->price }}">
                @if($errors->has('price'))
                <div class="error-text">
                    {{$errors->first('price')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">% khuyến mại</label>
            <div class="col-sm-9">
                <input type="number" class="form-control @error('sale') is-invalid @enderror" name="sale" placeholder="Nhập % khuyến mại...." value="{{ $product->sale }}">
                @if($errors->has('sale'))
                <div class="error-text">
                    {{$errors->first('sale')}}
                </div>
                @endif
            </div>
        </div>
        <div class="form-group row">
          <label for="" class="col-sm-3 col-form-label">Tag sản phẩm</label>
          <div class="col-sm-9">
            <select name="tag[]" class="form-control tag_select_choose" multiple="multiple">
            @foreach($product->tags as $tagItem)
                <option value="{{  $tagItem->name }}" selected>{{  $tagItem->name }}</option>
            @endforeach
            </select>
          </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label">Từ khóa</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa...." value="{{ $product->keyword }}">
        </div>
    </div>
        <div class="form-group row">
            <div class="col-sm-3">Nổi bật</div>
            <div class="col-sm-9">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="hot">
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
