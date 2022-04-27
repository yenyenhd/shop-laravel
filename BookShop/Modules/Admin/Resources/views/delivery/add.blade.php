@extends('admin::layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Delivery add</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Delivery</li>
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
        <form>
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Chọn thành phố</label>
                <div class="col-sm-9">
                    <select class="form-control choose province" name="province" id="province">
                        <option value="">---Chọn tỉnh thành phố---</option>
                        @foreach ($province as $pro)
                        <option value="{{ $pro->matp }}">{{ $pro->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Chọn quận huyện</label>
                <div class="col-sm-9">
                    <select class="form-control choose district" name="district" id="district">
                        <option value="0">---Chọn quận huyện---</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Chọn xã phường</label>
                <div class="col-sm-9">
                    <select class="form-control commune" name="commune" id="commune">
                        <option value="">---Chọn xã phường---</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label">Phí vận chuyển</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control fee_feeship_edit transport_fee" name="transport_fee" id="transport_fee">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9">
                <button type="button" class="btn btn-primary add_delivery" name="add_delivery">Thêm</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card-body" id="load_delivery"></div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){

            fetch_delivery();

            function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url : '{{url('/admin/delivery/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_delivery').html(data);
                }
            });
        }
        $('.choose').on('change', function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                
                if(action=='province'){
                    result = 'district';
                    
                }else{
                    result = 'commune';
                } 
                $.ajax({
                    url : '{{url('/admin/delivery/select')}}',
                    // url : 'http://localhost/BookShop/admin/delivery/select',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);     
                    }
                });
            });
            $('.add_delivery').click(function(){

                var province = $('.province').val();
                var district = $('.district').val();
                var commune = $('.commune').val();
                var transport_fee = $('.transport_fee').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : '{{url('/admin/delivery/create')}}',
                    method: 'POST',
                    data:{province:province, district:district, _token:_token, commune:commune, transport_fee:transport_fee},
                    success:function(data){
                        alert('Thêm phí vận chuyển thành công');
                    }
                });
            });
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
             var _token = $('input[name="_token"]').val();
            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url : '{{url('/admin/delivery/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                   fetch_delivery();
                }
            });

        });

            
            
        });
    </script>
@endsection
