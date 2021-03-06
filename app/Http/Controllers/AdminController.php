<?php

namespace App\Http\Controllers;

use App\orders;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;
use App\products;
use Illuminate\Http\Request;
use Storage;
use App\pro_cat;
use App\pro_brand;
use Image;
use App\products_properties;

class AdminController extends Controller {

    public function index() {

    return view('admin.index');
    }

    public function addpro_form(){
      $cat_data = DB::table('pro_cat')->get();
        $brand_data = DB::table('pro_brand')->get();

      return view('admin.home', compact('cat_data','brand_data'));
    }

    public function add_product(Request $request) {


        $file = $request->file('pro_img');
        $filename = $file->getClientOriginalName();

        $path = 'upload/images';
        $file->move($path, $filename);

        $products = new products;
        $products->pro_name = $request->pro_name;
        $products->cat_id = $request->cat_id;
        $products->brand_id = $request->brand_id;
        $products->pro_code = $request->pro_code;
        $products->pro_price = $request->pro_price;
        $products->pro_info = $request->pro_info;
        $products->spl_price = $request->spl_price;
        $products->pro_img = $filename;
        $products->save();

        $cat_data = DB::table('pro_cat')->get();
        $brand_data = DB::table('pro_brand')->get();

        return view('admin.home', compact('cat_data','brand_data'));

        //  return redirect()->action('AdminController@index')->with('status', 'Product Uploaded!');
    }

    public function view_products() {

        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')->get(); // now we are fetching all products


        return view('admin.products', compact('Products'));
    }

    public function view_orders() {

        $Orders = DB::table('users')->rightJoin('orders', 'orders.user_id', '=', 'users.id')->orderBy('orders.id','desc')->get();


        return view('admin.orders', compact('Orders'));
    }

    public function view_orders_pending() {

        $Orders = DB::table('users')->rightJoin('orders', 'orders.user_id', '=', 'users.id')->where('orders.status','pending')->orderBy('orders.id','desc')->get();


        return view('admin.ordersPending', compact('Orders'));
    }

    public function view_orders_confirmed() {

        $Orders = DB::table('users')->rightJoin('orders', 'orders.user_id', '=', 'users.id')->where('orders.status','confirmed')->orderBy('orders.id','desc')->get();


        return view('admin.ordersConfirmed', compact('Orders'));
    }

    public function view_orders_canceled() {

        $Orders = DB::table('users')->rightJoin('orders', 'orders.user_id', '=', 'users.id')->where('orders.status','canceled')->orderBy('orders.id','desc')->get();


        return view('admin.ordersCanceled', compact('Orders'));
    }


    public function view_order_details($id) {

        $ProductsDetails =  DB::table('orders_products')->rightJoin('products', 'products.id', '=', 'orders_products.products_id')->rightJoin('orders', 'orders.id', '=', 'orders_products.orders_id')->rightJoin('address', 'address.user_id', '=', 'orders.user_id')->where('orders_id', '=', $id)->get();

        return view('admin.orderDetails',compact('ProductsDetails'));
    }

    public function confirm_order($id) {

        DB::table('orders')->where('id', $id)->update(['status' => 'confirmed']);

        $Orders = DB::table('users')->rightJoin('orders', 'orders.user_id', '=', 'users.id')->orderBy('orders.id','desc')->get();


        return view('admin.orders', compact('Orders'));
    }

    public function cancel_order($id) {

        DB::table('orders')->where('id', $id)->update(['status' => 'canceled']);

        $Orders = DB::table('users')->rightJoin('orders', 'orders.user_id', '=', 'users.id')->orderBy('orders.id','desc')->get();


        return view('admin.orders', compact('Orders'));
    }

    public function date_product(Request $request,$id) {

        $begin = strtotime( $request->start_date) ;
        $qty_days = $request->qty_days*24*60*60;
        $end = $begin+$qty_days;
        $end_date = date("Y-m-d", $end);


        DB::table('products')->where('id', $id)->update(['start_date' => $request->start_date, 'end_date'=>$end_date,'stock'=>0]);

        return redirect()->back();
    }

    public function product_returned($id) {

        DB::table('products')->where('id', $id)->update(['start_date' => null, 'end_date'=>null,'stock'=>1]);

        return redirect()->back();
    }





    public function setStartDate(Request $request, $id) {



        $start_date = $request->start_date;


        DB::table('products')->where('id', $id)->update([
            'start_date' =>  $start_date

        ]);


        return view('admin.orderDetails',compact('ProductsDetails'));
    }

    public function add_cat() {

        return view('admin.addCat');
    }

    public function add_brand() {

        return view('admin.addBrand');
    }

    // add brand
    public function brandForm(Request $request) {
        //echo $request->cat_name;
        //return 'update query here';
        $pro_brand = new pro_brand;

        $pro_brand ->name = $request->brand_name;
        $pro_brand ->status = '0'; // by defalt enable
        $pro_brand ->save();

        $brands = DB::table('pro_brand')->orderby('id', 'DESC')->get();

        return view('admin.brands', compact('brands'));
    }

    // add cat
    public function catForm(Request $request) {
        //echo $request->cat_name;
        //return 'update query here';
        $pro_cat = new pro_cat;

        $pro_cat->name = $request->cat_name;
        $pro_cat->status = '0'; // by defalt enable
        $pro_cat->save();

        $cats = DB::table('pro_cat')->orderby('id', 'DESC')->get();

        return view('admin.categories', compact('cats'));
    }


    // edit form for brand
    public function BrandEditForm(Request $request) {
        $brandid = $request->id;
        $brands = DB::table('pro_brand')->where('id', $brandid)->get();
        return view('admin.BrandEditForm', compact('brands'));
    }

    // edit form for cat
    public function CatEditForm(Request $request) {
        $catid = $request->id;
        $cats = DB::table('pro_cat')->where('id', $catid)->get();
        return view('admin.CatEditForm', compact('cats'));
    }

    //update query to edit cat
    public function editCat(Request $request) {

        $catid = $request->id;
        $catName = $request->cat_name;
        $status = $request->status;
        DB::table('pro_cat')->where('id', $catid)->update(['name' => $catName, 'status' => $status]);

        $cats = DB::table('pro_cat')->orderby('id', 'DESC')->get();

        return view('admin.categories', compact('cats'));
    }

    //update query to edit brand
    public function editBrand(Request $request) {

        $brandid = $request->id;
        $brandName = $request->cat_name;
        $status = $request->status;
        DB::table('pro_brand')->where('id', $brandid)->update(['name' => $brandName, 'status' => $status]);

        $brands = DB::table('pro_brand')->orderby('id', 'DESC')->get();

        return view('admin.brands', compact('brands'));
    }

    public function view_cats() {

        $cats = DB::table('pro_cat')->get();

        return view('admin.categories', compact('cats'));
    }

    public function view_brands() {

        $brands = DB::table('pro_brand')->get();

        return view('admin.brands', compact('brands'));
    }

    public function ProductEditForm($id) {
        //$pro_id = $reqeust->id;
        $Products = DB::table('products')->where('id', '=', $id)->get(); // now we are fetching all products
        return view('admin.editPproducts', compact('Products'));
    }

    public function editProduct(Request $request) {

        $proid = $request->id;

        $pro_name = $request->pro_name;
        $cat_id = $request->cat_id;
        $pro_code = $request->pro_code;
        $pro_price = $request->pro_price;
        $pro_info = $request->pro_info;
        $spl_price = $request->spl_price;
        if($request->new_arrival =='NULL'){
          $new_arrival = '1';
        }else {
          $new_arrival = $request->new_arrival;
        }

        DB::table('products')->where('id', $proid)->update([
            'pro_name' => $pro_name,
            'cat_id' => $cat_id,
            'pro_code' => $pro_code,
            'pro_price' => $pro_price,
            'pro_info' => $pro_info,
            'spl_price' => $spl_price,
            'new_arrival' => $new_arrival

        ]);


        return redirect('/admin/products');
        //$Products = DB::table('pro_cat')->rightJoin('products','products.cat_id', '=', 'pro_cat.id')->get(); // now we are fetching all products
        //return view('admin.products', compact('Products'));
    }

    public function ImageEditForm($id) {
        $Products = DB::table('products')->where('id', '=', $id)->get(); // now we are fetching all products
        return view('admin.ImageEditForm', compact('Products'));
    }

    public function editProImage(Request $request) {

        $proid = $request->id;

        $file = $request->file('new_image');

        $filename = time() . '.' . $file->getClientOriginalName();


        $L_path = 'upload/images/';

        $img = Image::make($file->getRealPath());
        //$img->crop(300, 150, 25, 25);

        $img->resize(1000, 1000)->save($L_path . '/' . $filename);



       // $file->move($path, $filename);


        DB::table('products')->where('id', $proid)->update(['pro_img' => $filename]);
        return redirect('/admin/products');
        //echo 'done';
        //  $Products = DB::table('products')->get(); // now we are fetching all products
        //  return view('admin.products', compact('Products'));
    }

    //for delete cat
    public function deleteCat($id) {

        //echo $id;
        DB::table('pro_cat')->where('id', '=', $id)->delete();


        $cats = DB::table('pro_cat')->get();

        return view('admin.categories', compact('cats'));
    }

    //for delete brand
    public function deleteBrand($id) {

        //echo $id;
        DB::table('pro_brand')->where('id', '=', $id)->delete();


        $brands = DB::table('pro_brand')->get();

        return view('admin.brands', compact('brands'));
    }
    public function deleteProduct($id) {

        //echo $id;
        DB::table('products')->where('id', '=', $id)->delete();


        $Products = DB::table('pro_cat')->rightJoin('products', 'products.cat_id', '=', 'pro_cat.id')->get(); // now we are fetching all products


        return view('admin.products', compact('Products'));
    }

  public function sumbitProperty(Request $request){

    $properties = new products_properties;
    $properties->pro_id = $request->pro_id;
    $properties->size = $request->size;
    $properties->color = $request->color;
    $properties->p_price = $request->p_price;
    $properties->save();

    return redirect('/admin/ProductEditForm/'.$request->pro_id);

  }

  public function editProperty(Request $request){
         $uptProts = DB::table('products_properties')
          ->where('pro_id', $request->pro_id)
          ->where('id', $request->id)
          ->update($request->except('_token'));
          if($uptProts){
          return back()->with('msg', 'updated');
        }else {
        return back()->with('msg', 'check value again');
      }
  }

    public function addSale(Request $request){
      $salePrice = $request->salePrice;
      $pro_id = $request->pro_id;
      DB::table('products')->where('id', $pro_id)->update(['spl_price' => $salePrice]);
      echo 'added successfully';
    }

    public function addAlt($id){
      $proInfo = DB::table('products')->where('id', $id)->get();
      return view('admin.addAlt', compact('proInfo'));
    }

    public function submitAlt(Request $request){
     $file = $request->file('image');
      $filename  = time() . $file->getClientOriginalName(); // name of file

      $path = "public/img/alt_images";
      $file->move($path,$filename); // save to our local folder
      $proId = $request->pro_id;
      $add_lat = DB::table('alt_images')
      ->insert(['proId' => $proId, 'alt_img' => $filename, 'status' =>0]);
      return back();
    }




}
