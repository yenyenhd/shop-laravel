@extends('admin::layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Product add</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('list.product') }}">Product</a></li>
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
    <div class="col-md-12">
        <form action="{{ route('product.store') }} " method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Tên sản phẩm</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên sản phẩm...." value="{{ old('name') }}">
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
                            <textarea class="form-control" rows="5" id="content_product" placeholder="Nội dung...." name="content">{{ old('content') }}</textarea>
                            @if($errors->has('content'))
                            <div class="error-text">
                                {{$errors->first('content')}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Hình ảnh</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file @error('avatar_path') is-invalid @enderror" name="avatar_path" >
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
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" placeholder="Nhập số lượng...." value="{{ old('quantity') }}">
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
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Nhập giá...." value="{{ old('price') }}">
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
                            <input type="number" class="form-control @error('sale') is-invalid @enderror" name="sale" placeholder="Nhập % khuyến mại...." value="{{ old('sale') }}">
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
                        <select name="tag[]" class="form-control tag_select_choose" multiple="multiple"></select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Từ khóa</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa...." value="{{ old('keyword') }}">
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

                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    CKEDITOR.replace('description', options);
    CKEDITOR.replace('content_product', options);
</script>

@endsection
