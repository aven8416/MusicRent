@extends('front.master')

@section('content')
    <style>
        table td { padding:10px
        }</style>



    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{url('/profile')}}">Profile</a></li>
                    <li class="active">My Order</li>
                </ol>
            </div><!--/breadcrums-->



            <div class="row">
                @include('profile.menu')
                <div class="col-md-8">
                    <h3 ><span style='color:green'>{{ucwords(Auth::user()->name)}}</span>,  Your Orders</h3>
                        <a href="{{url('/orders')}}">View orders</a>
                    <hr>
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Product image</th>
                            <th>Product name</th>
                            <th>Product Code</th>
                            <th>Price</th>
                            <th>Amount of days</th>
                        </tr>
                        </thead>

                        <?php $count =1;?>

                        @foreach($ProductsDetails as $product)
                            <tbody>
                            <tr>
                                <td> <img src="/upload/images/<?php echo $product->pro_img; ?>" alt=""
                                          width="50px" height="50px"/></td>
                                <td>{{ucwords($product->pro_name)}}</td>
                                <td>{{$product->pro_code}}</td>
                                <td>{{$product->pro_price}}</td>
                                <td>{{$product->qty}}</td>
                            </tbody>
                            <?php $count++;?>
                        @endforeach
                    </table>
                    <hr>
                </div>
            </div>
        </div>
    </section>
@endsection
