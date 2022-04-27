@extends('layouts.master')

@section('content')
<div class="breadcrumb_container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">     
                <nav>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a> ></li>
                        <li>history</li>
                    </ul>
                </nav>
            </div>
        </div> 
    </div>        
</div>
<div class="cart_main_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="panel-heading text-center mb-30">
                        <h3>Danh sách đơn hàng</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th class="img-thumbnail">Mã đơn hàng</th>
                                <th class="product-quantity">Ngày đặt</th>
                                <th class="product-subtotal">Tình trạng đơn hàng</th>
                                <th class="product-remove">Xem chi tiết</th>
                                <th class="product-remove">Hủy đơn hàng</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getorder as $key => $ord)
                            <tr>
                                <td>{{ $ord->code }}</td>
                                <td>{{ $ord->created_at }}</a></td>
                                <td>
                                    @if($ord->status == 1)
                                        <span class="text text-success">Đơn hàng mới</span>
                                    @elseif($ord->status == 2)
                                        <span class="text text-primary">Đã xử lý - Đã giao hàng</span>
                                    @else
                                        <span class="text text-danger">Đơn hàng đã bị hủy</span>
                                    @endif
                                </td>
                                <td><a href="{{URL::to('/view-history-order/'.$ord->code)}}"><i class="fas fa-eye" style="color: rgb(78, 202, 78); font-size: 25px"></i></a></td>
                                <td>
                                    @if($ord->status != 3)
                                     <p><button style="margin-top: 10px; cursor: pointer" type="button" class="btn btn-danger" data-toggle="modal" data-target="#huydon"><i class="fas fa-times" style="color: rgb(233, 221, 221); font-size: 25px" ></i></button></p>
                                    @endif

                                    {{-- Modal --}}
                                    <div id="huydon" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <form>
                                            {{ csrf_field() }}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Lý do hủy đơn hàng</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><textarea rows="5" class="lydohuydon" required placeholder="Lý do hủy đơn hàng....(bắt buộc)"></textarea></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                        <button type="button" id="{{  $ord->code }}" onclick="Huydonhang(this.id)" class="btn btn-success">Gửi lý do hủy</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    
                    </table>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="col-sm-5 text-center">
             {{--  <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
            </div>
            <div class="col-sm-7 text-right text-center-xs">                
              <ul class="pagination pagination-sm m-t-none m-b-none">
                {!!$getorder->links()!!}
              </ul>
            </div>
          </div>   
    </div>   
</div>
@endsection
@section('js')
<script type="text/javascript">
    function Huydonhang(id){
        var order_code = id;
        var cause = $('.lydohuydon').val();
        var _token = $('input[name="_token"]').val();
        alert(order_code);

        // $.ajax({
        //     url:'{{url('/cancel-order')}}',
        //     method:"POST",

        //     data:{order_code:order_code, cause:cause, _token:_token},
        //     success:function(data){
        //         alert('Hủy đơn hàng thành công');
        //         location.reload(); 
        //     }

        // }); 
    }
</script>
@endsection
