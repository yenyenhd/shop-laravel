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
    <div class="row  mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back!</h4>
                <span class="ml-1">Comment</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home </a></li>
                <li class="breadcrumb-item"><a href="">comment</a></li>
                <li class="breadcrumb-item active">list</li>
            </ol>
        </div>
    </div>
</div>

@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
 @endif

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display" style="min-width: 845px" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Người bình luận</th>
                            <th>Sản phẩm</th>
                            <th>Nội dung</th>
                            <th>Ngày gửi</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comment as $com)
                            <tr>
                                <td>{{ $com->id }}</td>
                                <td>{{ $com->customer->name }}</td>
                                <td><a href="{{ route('product_detail', ['slug' => $com->product->slug]) }}" target="_blank">{{ $com->product->name }}</a></td>
                                <td>{{ $com->content }}
                                    {{-- <style type="text/css">
                                        ul.list_rep li {
                                          list-style-type: decimal;
                                          color: blue;
                                          margin: 5px 40px;
                                      }
                                      </style>
                                      <ul class="list_rep">
                                          @foreach($comment_rep as $key => $comm_reply)
                                            @if($comm_reply->parent_id == $com->id)
                                              <li> {{$comm_reply->content}}</li>
                                            @endif
                                          
                                          @endforeach
                            
                                      </ul>
                                      @if($com->status==1)
                                      <form action="{{ route('reply_comment', [ 'id' => $com->product_id]) }}" method="POST">
                                          {{ csrf_field() }}
                                          <input type="hidden" name="parent_id" value="{{ $com->id }}">
                                          <input type="text" class="form-control" name="content">
                                       
                                      <br/><button type="submit" class="btn btn-default btn-xs btn-reply-comment">Reply</button>
                                      </form>
                                      
                                      
                                      @endif --}}
                                </td>
                                <td>{{ $com->created_at }}</td>
                                <td>
                                    <a href="{{ route('comment.action', ['active',$com->id]) }}" class="badge badge-pill {{ $com->getStatus($com->active)['class'] }}">{{ $com->getStatus($com->active)['name'] }}</a>
                                </td>
                                <td>
        
                                    {{-- @can('category delete') --}}
                                    <a style="color: red; font-size: 20px;" href="" data-url="{{ route('comment.action', ['delete',$com->id]) }}" class="action-delete"><i class="ti-trash"></i></a>
                                {{--  @endcan --}}
                                </td>

                            </tr>
                       @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection
