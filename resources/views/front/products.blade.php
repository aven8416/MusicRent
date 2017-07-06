<div class="features_items"> <!--features_items-->
      <b> Total Products</b>:  {{$Products->total()}}
                    <h2 class="title text-center">
                       <?php
                        if (isset($msg)) {
                            echo $msg;
                        } else {
                            ?> Features Item <?php } ?> </h2>

                    <?php if ($Products->isEmpty()) { ?>
                        sorry, products not found
                    <?php } else { ?>
                        @foreach($Products as $product)
                        <div class="col-sm-4" >
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('/product_details')}}">
                                            <img src="/upload/images/<?php echo $product->pro_img; ?>" alt="" />
                                        </a>
                                        <h2 id="price">
                                            @if($product->spl_price==0)
                                                ${{$product->pro_price}}
                                            @else
                                                <span style="text-decoration:line-through; color:#ddd">
                                           ${{$product->pro_price}} </span>
                                                ${{$product->spl_price}}
                                            @endif<p style="font-size: 14px; color:#696763">per day</p>

                                        </h2>
                                        <?php $brand = DB::table('pro_brand')->where('id',$product->brand_id)->get()->first();?>
                                        <p><a href="{{url('/product_details')}}"><?php echo ucwords($brand->name)?>  <?php echo  $product->pro_name; ?></a></p>
                                        @if($product->stock == 1)
                                            <a href="{{url('/cart/addItem')}}/<?php echo $product->id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        @else
                                            <h2 style="color:red">Reserved</h2>
                                        @endif
                                    </div>
                                    <a href="{{url('/product_details')}}/<?php echo $product->id; ?>">
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>
                                                    @if($product->spl_price==0)
                                                        ${{$product->pro_price}}
                                                    @else
                                                        <img src="images/shop/on-sale.png" style="width:60px"/>
                                                        <span style="text-decoration:line-through; color:#ddd">
                                                   ${{$product->pro_price}} </span>
                                                        ${{$product->spl_price}}
                                                    @endif
                                                    <p style="font-size: 14px; color:#fff">per day</p>
                                                </h2>
                                                <?php $brand = DB::table('pro_brand')->where('id',$product->brand_id)->get()->first();?>
                                                <p><?php echo ucwords($brand->name)?> <?php echo $product->pro_name; ?></p>

                                                @if($product->stock == 1)
                                                    <a href="{{url('/cart/addItem')}}/<?php echo $product->id; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                @else
                                                    <h2 style="color:red">Reserved</h2>
                                                @endif
                                            </div>
                                        </div></a>
                                </div>
                                <div class="choose">
                                    <?php
                                    $wishData = DB::table('wishlist')->leftJoin('products', 'wishlist.pro_id', '=', 'products.id')->where('wishlist.pro_id', '=', $product->id)->get();
                                    $count = App\wishList::where(['pro_id' => $product->id])->count();
                                    ?>

                                    <?php if ($count == "0") { ?>
                                        <form action="{{url('/addToWishList')}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$product->id}}" name="pro_id"/>
                                            <p align="center">
                                                <input type="submit" value="Add to WishList" class="btn btn-primary"/>
                                            </p>
                                        </form>
                                    <?php } else { ?>
                                        <h5 style="color:green"> Added to <a href="{{url('/WishList')}}">wishList</a></h5>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>

                        @endforeach
                    <?php } ?>


                </div>
                <ul class="pagination">
                    {{ $Products->links()}}
                </ul>