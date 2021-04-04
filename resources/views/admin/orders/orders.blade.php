@extends('layouts.admin')

@section('content')
<!-- Page-header start -->
    <div class="page-header">
        <div class="row align-items-end">
            
            <div class="col-lg-12">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}"> <i class="feather icon-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Danh sách đơn hàng</a>
                        </li>
                        <!-- <li class="breadcrumb-item"><a href="#!">Basic Initialization</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="row">
        <div class="col-sm-12 filter-bar">
        	<nav class="navbar navbar-light bg-faded m-b-30 p-10">
                                                    <ul class="nav navbar-nav">
                                                        <li class="nav-item active">
                                                            <a class="nav-link" href="#!"><span class="sr-only">(current)</span></a>
                                                        </li>
                                                        
                                                        <!-- end of by date dropdown -->
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#!" id="bystatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-chart-histogram-alt"></i> Trạng thái</a>
                                                            <div class="dropdown-menu" aria-labelledby="bystatus">
                                                                <a class="dropdown-item" href="#!">Tất cả</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#!">Đang chờ</a>
                                                                <a class="dropdown-item" href="#!">Đã giao</a>
                                                                <a class="dropdown-item" href="#!">Đã hủy</a>
                                                            </div>
                                                        </li>
                                                        <!-- end of by status dropdown -->
                                                        <li>
                                                            <div style="margin:10px 0px;">
                                                                <input type="text" name="" class="form-control" placeholder="Mã đơn hàng...">
                                                            </div>
                                                        </li>
                                                        </ul>
                                                        <div class="nav-item nav-grid">
                                                                <a href="{{ route('add.order') }}" title="Tạo đơn hàng mới" class="btn btn-sm btn-primary">
                                                                    <i class="icofont icofont-plus"></i> Tạo đơn hàng mới
                                                                </a>
                                                        </div>
                                                        <!-- end of by priority dropdown -->

                                                </nav>
        </div>
    </div>
    <div class="row">
        @foreach($list_orders as $order)
            @php
                switch($order->status){
                    case 1:
                        $color = "warning";
                        break;
                    case 4:
                        $color = "success";
                        break;
                    case 5:
                        $color = "danger";
                        break;
                    default:
                        
                }
            @endphp
                <div class="col-sm-6">
                    <div class="card card-border-{{$color}}">
                        <div class="card-header">
                            <a href="#">
                                <label class="label label-inverse-{{$color}}">Mã đơn #: &nbsp;{{$order->id}} </label>
                            </a>
                            <!-- <span class="label label-default f-right"> 28 January, 2015 </span> -->
                            <div class="dropdown-secondary dropdown f-right">
                                <span class="f-left m-r-5 text-inverse">
                                    <a href="#" onclick="showCustomer({{$order->customer_id}})">
                                        <label class="label label-inverse">{{$order->name_receiver}}</label>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list list-unstyled">
                                        <li><b><u>Người nhận</u></b>: {{$order->name_receiver}}</li>
                                        <li><b><u>Điện thoại</u></b>: <span class="text-semibold">{{$order->phone_receiver}}</span></li>
                                        <li><b><u>Địa chỉ</u></b>: <span class="text-semibold">{{$order->address_receiver}}</span></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list list-unstyled text-right">
                                        <li><i>{{ date('d/m/Y', strtotime($order->order_date)) }}</i></li>
                                        <li>
                                            @if($order->person_pay_shipping == 1)         
                                                  <span class="text-semibold"><b><i>Khách trả cước ship</i></b></span>    
                                            @else
                                                  <span class="text-semibold"><b><i>Bao cước ship</i></b></span>  
                                            @endif
                                            
                                        </li>
                                        <li><span style="color: #fe9365;"><i>{{$order->note}}</i></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="task-list-table">
                                <p class="task-due">
                                    @switch($order->status)
                                        @case(1)
                                            <strong class="label label-warning">Đang chờ</strong>
                                            @break
                                        @case(4)
                                            <strong class="label label-success">Đã giao</strong>
                                            @break
                                        @case(5)
                                            <strong class="label label-danger">Đã hủy</strong>
                                            @break
                                        @default
                                            
                                    @endswitch
                                    
                                </p>
                            </div>
                            <div class="task-board m-0">
                                <!-- end of dropdown-secondary -->
                                <div class="dropdown-secondary dropdown">
                                    <button class="btn btn-info btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Print Invoice</a>
                                        <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Download invoice</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Edit Invoice</a>
                                        <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Remove Invoice</a>
                                    </div>
                                    <!-- end of dropdown menu -->
                                </div>
                                <!-- end of seconadary -->
                            </div>
                            <!-- end of pull-right class -->
                        </div>
                        <!-- end of card-footer -->
                    </div>
                </div>
            
        @endforeach                                
    </div>
@endsection

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title" id="divID">THÔNG TIN KHÁCH HÀNG</h4>
          <button type="button" class="close" data-dismiss="modal" title="Đóng">&times;</button>
        </div>
        <div class="modal-body">
           Tên khách hàng : <span id="name_cus"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
</div>
<!-- @push('ajax_crud')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endpush  -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
<script>
   function deleteProduct(id){
         Swal.fire({
       title: 'Bạn có chắc chắn muốn xóa sản phẩm này không?',
       text: "Bạn sẽ không thể lấy lại sản phẩm này sau khi xóa.",
       icon: 'warning',
       type: 'warning',
       timer: 14400, 
       showCancelButton: true,
       showConfirmButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Có, xóa nó đi!'
     }).then((result) => {
       if (result.value) {
            $.ajax({
                type: "GET",
                url: "{{url('/product/delete-product/')}}/"+id,
                success: function (data) {
                    }         
            });
         Swal.fire(
           'Đã xóa sản phẩm!',
           'Bạn đã xóa sản phẩm!',
           'success',
         )
       }
       location.reload();
     })
   }


   function showCustomer(id_cus)
    {
        $("#myModal").modal('show');

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        
        // get price from Quickbook API
        $.ajax({
            url: "/customer/show-customer/"+id_cus,
            type: 'GET',
            success: function (data) {
                console.log(data);
                $("#name_cus").html(data.name);
            },
        });
    }
</script>


                                                                              