@extends('front.master')

@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>






        <form action="{{url('/')}}/formvalidate" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="shopper-info">
                            <p>Shopper Information</p>

                            @if(count($address_data)==0)
                                <label>Your Name</label>
                                <input type="text" name="fullname"  placeholder="Your Name" class="form-control"  >

                                <span style="color:red">{{ $errors->first('fullname') }}</span>
                                <hr>

                                <label>Your city</label>
                                <select name="city" class="form-control" >
                                <option value="" selected="selected">Select city</option>
                                <option value="Minsk">Minsk</option>
                                <option value="Gomel">Gomel</option>
                                <option value="Vitebsk">Vitebsk</option>
                                <option value="Brest">Brest</option>
                                <option value="Mogilev">Mogilev</option>
                                <option value="Grodno">Grodno</option>
                                </select>

                                <span style="color:red">{{ $errors->first('city') }}</span>
                                <hr>

                                <label>Your address</label>
                                <input type="text" name="address"  placeholder="Your address" class="form-control" >

                                <span style="color:red">{{ $errors->first('address') }}</span>
                                <hr>

                                <label>Your phone</label>
                                <input type="tel" name="phone"  placeholder="Your phone" class="form-control" >

                                <span style="color:red">{{ $errors->first('phone') }}</span>
                                <hr>
                                <label>Birth of Date</label>
                                <input type="date" name="birth"  placeholder="Birth of Date" class="form-control"  >
                                <span style="color:red">{{ $errors->first('birth') }}</span>
                                <hr>

                                {{--    <!-- Drop-off date/time start -->
                                     <div class="datetime drop-off">
                                         <div class="date pull-left">
                                             <div class="input-group">
                                                 <span class="input-group-addon pixelfix"><span class="glyphicon glyphicon-calendar"></span> Date of Birth</span>
                                                 <input type="text" name="birth" id="birth" value="{{ Carbon\Carbon::parse($value->birth)->format('d-m-Y i') }}" class="form-control datepicker" placeholder="dd/mm/yyyy">
                                                 <span style="color:red">{{ $errors->first('birth') }}</span>
                                             </div>
                                         </div>
                                         <div class="clearfix"></div>
                                     </div>
                                     <!-- Drop-off date/time end -->
                                     <hr>--}}
                                <label>Passport Number</label>
                              <input type="text" placeholder="Passport Number" name="passport_n" class="form-control" >

                                <span style="color:red">{{ $errors->first('passport_n') }}</span>

                                <hr>
                                <label>Identification Number</label>
                                <input type="text" placeholder="Identification Number" name="identification_n" class="form-control" >

                                <span style="color:red">{{ $errors->first('identification_n') }}</span>

                            @else
                                @foreach($address_data as $value)
                                    <label>Your Name</label>
                                    <input type="text" name="fullname"  placeholder="Your Name" class="form-control"  value="{{ $value->fullname}}">

                                    <span style="color:red">{{ $errors->first('fullname') }}</span>
                                    <hr>
                                    <label>Your city</label>
                                    <select name="city" class="form-control" >
                                        <option value="{{$value->city}}" selected="selected">{{$value->city}}</option>
                                        <option value="Minsk">Minsk</option>
                                        <option value="Gomel">Gomel</option>
                                        <option value="Vitebsk">Vitebsk</option>
                                        <option value="Brest">Brest</option>
                                        <option value="Mogilev">Mogilev</option>
                                        <option value="Grodno">Grodno</option>
                                    </select>
                                    <span style="color:red">{{ $errors->first('city') }}</span>

                                    <hr>
                                    <label>Your address</label>
                                    <input type="text" name="address"  placeholder="Your address" class="form-control"  value="{{ $value->address }}">

                                    <span style="color:red">{{ $errors->first('address') }}</span>
                                    <hr>
                                    <label>Your phone</label>
                                    <input type="text" name="phone"  placeholder="Your phone" class="form-control"  value="{{ $value->phone }}">

                                    <span style="color:red">{{ $errors->first('phone') }}</span>
                                    <hr>
                                        <label>Birth of Date</label>
                                    <input type="date" name="birth"  placeholder="Birth of Date" class="form-control"  value="{{$value->birth}}">

                                    <span style="color:red">{{ $errors->first('birth') }}</span>
                                    <hr>

                                    {{--    <!-- Drop-off date/time start -->
                                         <div class="datetime drop-off">
                                             <div class="date pull-left">
                                                 <div class="input-group">
                                                     <span class="input-group-addon pixelfix"><span class="glyphicon glyphicon-calendar"></span> Date of Birth</span>
                                                     <input type="text" name="birth" id="birth" value="{{ Carbon\Carbon::parse($value->birth)->format('d-m-Y i') }}" class="form-control datepicker" placeholder="dd/mm/yyyy">
                                                     <span style="color:red">{{ $errors->first('birth') }}</span>
                                                 </div>
                                             </div>
                                             <div class="clearfix"></div>
                                         </div>
                                         <!-- Drop-off date/time end -->
                                         <hr>--}}
                                            <label>Passport Number</label>
                                    <input type="text" placeholder="Passport Number" name="passport_n" class="form-control" value="{{ $value->passport_n }}">

                                    <span style="color:red">{{ $errors->first('passport_n') }}</span>

                                    <hr>
                                                <label>Identification Number</label>
                                    <input type="text" placeholder="Identification Number" name="identification_n" class="form-control" value="{{ $value->identification_n}}">

                                    <span style="color:red">{{ $errors->first('identification_n') }}</span>

                                    <hr>

                                @endforeach
                            @endif


                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                            <label><input type="checkbox"> Shipping to bill address</label>
                        </div>
                    </div>
                </div>
            </div>


        <div class="review-payment">
            <h2>Review</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Amount of days</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="/upload/images/{{$cartItem->options->img}}" alt="" width="100px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cartItem->name}}</a></h4>
                            <p>Web ID: {{$cartItem->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{$cartItem->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">

                                <input class="cart_quantity_input" type="text"  value="{{$cartItem->qty}}" readonly="readonly" size="2">

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$cartItem->subtotal}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{url('/cart/remove')}}/{{$cartItem->rowId}}"><i class="fa fa-times"></i></a>

                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>${{Cart::subtotal()}}</td>
                                </tr>
                               {{-- <tr>
                                    <td> Tax</td>
                                    <td>${{Cart::tax()}}</td>
                                </tr>--}}
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>${{Cart::total()}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="payment-options">
        <span>
            <input type="submit" value="Submit" class="btn btn-primary" id="cashbtn">
            </span>
    </div>
    </div>

      </form>




</section> <!--/#cart_items-->


@endsection
