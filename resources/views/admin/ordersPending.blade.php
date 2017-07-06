@extends('admin.master')

@section('content')
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            <?php for($i=1;$i<60;$i++){?>
            // start loop
            $('#amountDiv<?php echo $i;?>').hide();
            $('#checkSale<?php echo $i;?>').show();
            $('#onSale<?php echo $i;?>').click(function(){  // run when admin need to add amount for sale
                $('#amountDiv<?php echo $i;?>').show();
                $('#checkSale<?php echo $i;?>').hide();
                $('#saveAmount<?php echo $i;?>').click(function(){
                    var salePrice<?php echo $i;?> = $('#spl_price<?php echo $i;?>').val();
                    var pro_id<?php echo $i;?> = $('#pro_id<?php echo $i;?>').val();
                    $.ajax({
                        type: 'get',
                        dataType: 'html',
                        url: '<?php echo url('/admin/addSale');?>',
                        data: "salePrice=" + salePrice<?php echo $i;?> + "& pro_id=" + pro_id<?php echo $i;?>,
                        success: function (response) {
                            console.log(response);
                        }
                    });
                });
            });
            $('#noSale<?php echo $i;?>').click(function(){ // this when admin dnt need sale
                $('#amountDiv<?php echo $i;?>').hide();
                $('#checkSale<?php echo $i;?>').show();

            });
            //end loop
            <?php }?>
        });

    </script>
    <section id="container" class="">
        @include('admin.sidebar')
        <section id="main-content">
            <section class="wrapper">
                <div class="content-box-large">
                    <h1>Orders</h1>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User name</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <?php $count =1;?>
                        @foreach($Orders as $order)

                            <tbody>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{ucwords($order->name)}}</td>

                                @if($order->status=='confirmed')
                                    <td ><p style="background-color: #4cd964 ; color: #FFFFFF;padding-left: 15px">{{$order->status}}</p></td>
                                @elseif($order->status=='canceled')
                                    <td><p style="background-color: #ff2d55; color: #FFFFFF;padding-left: 15px">{{$order->status}}</p></td>
                                @else
                                    <td><p style="background-color: #34aadc ; color: #FFFFFF;padding-left: 15px">{{$order->status}}</p></td>
                                @endif
                                <td>{{$order->total}}</td>
                                @if($order->payment_type == 'COD')
                                    <td>Not paid</td>
                                @else
                                    <td>paid</td>
                                @endif
                                <td><a href="{{url('/')}}/admin/orders/orderDetails/{{$order->id}}"
                                       class="btn btn-info btn-small">See Details</a></td>

                                <td>
                                    <div class="row">
                                        <a href="{{url('/')}}/admin/orders/confirm/{{$order->id}}"
                                           class="btn btn-success btn-small">Confirm</a>
                                        <a href="{{url('/')}}/admin/orders/cancel/{{$order->id}}"
                                           class="btn btn-danger btn-small">Cancel</a>
                                    </div>
                                </td>
                            </tbody>
                            <?php $count++;?>
                        @endforeach
                    </table>
                </div>
            </section>
        </section>
    </section>

@endsection
