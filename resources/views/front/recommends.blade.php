<?php
$products1 = DB::table('recommends')
        ->leftJoin('products','recommends.pro_id','products.id')
        ->select('pro_id','pro_name','pro_img','pro_price', 'brand_id','stock', DB::raw('count(*) as total'))
        ->groupBy('pro_id','pro_name','pro_img','pro_price','brand_id' ,'stock')
        ->orderby('total','DESC')
        ->take(3)
        ->get();
if(Auth::check()){
 $products2 = DB::table('recommends')
         ->leftJoin('products','recommends.pro_id','products.id')     
         ->where('uid',Auth::user()->id)
         ->inRandomOrder()
        ->take(3)
        ->get();
}else{
 $products2 = DB::table('recommends')
         ->leftJoin('products','recommends.pro_id','products.id')
         ->inRandomOrder()
        ->take(3)
        ->get();
}    
?>
<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">	
                                      @foreach($products1 as $p)
                                       <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                       <a href="{{url('/product_details')}}/{{$p->pro_id}}"> 
                                                           <img src="/upload/images/{{$p->pro_img}}" alt="" /></a>
                                                        <h2>${{$p->pro_price}}<span style="font-size: 14px; color:#696763">/day</span></h2>
                                                        <?php $brand = DB::table('pro_brand')->where('id',$p->brand_id)->get()->first();?>
                                                        <p>  <a href="{{url('/product_details')}}/{{$p->pro_id}}">{{$brand->name}} {{$p->pro_name}}</a></p>
                                                        @if($p->stock == 1)
                                                            <a href="{{url('/cart/addItem')}}/{{$p->pro_id}}" class="btn btn-default add-to-cart">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                Add to cart</a>
                                                        @else
                                                            <h2 style="color:red">Reserved</h2>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                    </div>
                                    <div class="item">	
                                         @foreach($products2 as $p)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <a href="{{url('/product_details')}}/{{$p->pro_id}}"> 
                                                            <img src="/upload/images/{{$p->pro_img}}" alt="" /></a>
                                                        <h2>${{$p->pro_price}}<span style="font-size: 14px; color:#696763">/day</span></h2>
                                                        <?php $brand = DB::table('pro_brand')->where('id',$p->brand_id)->get()->first();?>
                                                        <p>  <a href="{{url('/product_details')}}/{{$p->pro_id}}">{{$brand->name}} {{$p->pro_name}}</a></p>

                                                        @if($p->stock == 1)
                                                            <a href="{{url('/cart/addItem')}}/{{$p->pro_id}}" class="btn btn-default add-to-cart">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                Add to cart</a>
                                                        @else
                                                            <h2 style="color:red">Reserved</h2>
                                                        @endif

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                      @endforeach
                                      
                                    </div>
                                </div>
                                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>			
                            </div>