<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\address;

class ProfileController extends Controller {

    public function index() {
        return view('profile.index');
    }

    public function orders() {
        $user_id = Auth::user()->id;
        $orders = DB::table('orders')->where('orders.user_id', '=', $user_id)->get();

        return view('profile.orders', compact('orders'));
    }

    public function view_order_details($id) {
        $ProductsDetails =  DB::table('orders_products')->rightJoin('products', 'products.id', '=', 'orders_products.products_id')->rightJoin('orders', 'orders.id', '=', 'orders_products.orders_id')->where('orders_id', '=', $id)->get();

        return view('profile.orderDetails', compact('ProductsDetails'));
    }


    public function Address() {
        $user_id = Auth::user()->id;
        $address_data = DB::table('address')->where('user_id', '=', $user_id)->orderby('id', 'DESC')->get();
        return view('profile.address', compact('address_data'));
    }

    public function updateAddress(Request $request) {
        $this->validate($request, [
            'fullname' => 'required|min:2|max:50',
            'passport_n' => 'required|min:9|max:9',
            'identification_n' => 'required|min:14|max:14',
            'address' => 'required']);

        $userid = Auth::user()->id;
        DB::table('address')->where('user_id', $userid)->update($request->except('_token'));

        return back()->with('msg','Your address has been updated');
    }

    public function Password() {
        return view('profile.updatePassword');
    }

    public function updatePassword(Request $request) {
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;


        if(!Hash::check($oldPassword, Auth::user()->password)){
          return back()->with('msg','The specified password does not match the database password'); //when user enter wrong password as current password

        }else{
            $request->user()->fill(['password' => Hash::make($newPassword)])->save(); //updating password into user table
           return back()->with('msg','Password has been updated');
        }
       // echo 'here update query for password';
    }

}
