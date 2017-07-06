@extends('admin.master')

@section('content')
{{--<script src="https://code.jquery.com/jquery.min.js"></script>--}}
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){

        var date = $("#start_date").val();
        console.log('kfsgs');
        $("#end_date").val(date);

    });

</script>
<section id="container" class="">
    @include('admin.sidebar')
    <section id="main-content">
        <section class="wrapper">
            <div class="content-box-large">
                <h1>Order Details</h1>
                <a href="{{url('/')}}/admin/orders">View Orders</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Birth</th>
                        <th>Passport Number</th>
                        <th>Identification Number</th>
                    </tr>
                    </thead>

                    <?php $count =0;?>
                    @foreach($ProductsDetails as $product)
                       @if($count==0)
                        <tbody>
                        <tr>
                            <td style="color:#0d6948">{{ucwords($product->fullname)}}</td>
                            <td>{{ucwords($product->city)}}</td>
                            <td>{{ucwords($product->address)}}</td>
                            <td>{{ucwords($product->phone)}}</td>
                            <td>{{$product->birth}}</td>
                            <td>{{$product->passport_n}}</td>
                            <td>{{$product->identification_n}}</td>
                        </tbody>
                        @endif
                            <?php $count++;?>
                    @endforeach

                </table>

<hr>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Product image</th>
                        <th>Product name</th>
                        <th>Product ID</th>
                        <th>Product Code</th>
                        <th>Product status</th>
                        <th>Product Period</th>
                        <th>Price</th>
                        <th>Amount of days</th>
                        <th>Start Date</th>
                        <th>Qty days</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <?php $count =1;?>
                    @foreach($ProductsDetails as $product)
                    <tbody>
                    <tr>
                        <td> <img src="/upload/images/<?php echo $product->pro_img; ?>" alt=""
                                  width="50px" height="50px"/></td>
                        <td>{{ucwords($product->pro_name)}}</td>
                        <td>{{$product->products_id}}</td>
                        <td>{{$product->pro_code}}</td>
                        @if($product->stock)
                        <td ><p style="background-color: #26da1b ; color: #FFFFFF;padding-left: 15px">In stock</p></td>
                        @else
                            <td><p style="background-color: #fb6965 ; color: #FFFFFF;padding-left: 15px">Reserved</p></td>
                            @endif
                        @if($product->start_date == null && $product->end_date == null)
                            <td>No period</td>
                            @else
                        <td>{{date('F j, Y', strtotime($product->start_date))}}<br>{{  date('F j, Y', strtotime($product->end_date))}}</td>
                        @endif
                        <td>{{$product->pro_price}}</td>
                        <td>{{$product->qty}}</td>

                        {!! Form::open(['url' => 'admin/orders/product_date/'.$product->products_id,  'method' => 'post']) !!}
                        <td>
                            <input  type="date" placeholder="Start date" size="5"   onchange="" name="start_date" id="start_date"  class="form-control ">
                        </td>
                        <td>

                            <input  type="text" placeholder="qty" size="2"  onchange="" name="qty_days" id="qty_days"  class="form-control">

                        </td>
                        <td>
                            <input type="submit" class="btn btn-info btn-small" value="Submit" />
                            {!! Form::close() !!}

                        <a href="{{url('/')}}/admin/orders/product_returned/{{$product->products_id}}/"
                           class="btn btn-danger btn-small">Returned</a>

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

