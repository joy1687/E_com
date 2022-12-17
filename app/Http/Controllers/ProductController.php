<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Buy;
class ProductController extends Controller
{
    //
    function index()
    {
        $data= Product::all();

       return view('product',['products'=>$data]);
    }
    function detail($id)
    {
        $data =Product::find($id);
        return view('detail',['product'=>$data]);
        
    }
    function search(Request $req)
    {
        $data= Product::
        where('name', 'like', '%'.$req->input('query').'%')
        ->get();
        return view('search',['products'=>$data]);
        //return $req->input();
    }
    function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $cart= new Cart;
            $cart->user_id=$req->session()->get('user')['id'];
            $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    }
    static function cartItem()
    {
     $userId=Session::get('user')['id'];
     return Cart::where('user_id',$userId)->count();
    }
    function cartList()
    {
        $userId=Session::get('user')['id'];
       $products= DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();

        return view('cartlist',['products'=>$products]);
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    function buyNow()
    {
        $userId=Session::get('user')['id'];
        $total= $products= DB::table('cart')
         ->join('products','cart.product_id','=','products.id')
         ->where('cart.user_id',$userId)
         ->sum('products.price');
 
         return view('buynow',['total'=>$total]);
    }
    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
        $allCart= Cart::where('user_id',$userId)->get();
        foreach($allCart as $cart)
        {
            $buy= new Buy;
            $buy->product_id=$cart['product_id'];
            $buy->user_id=$cart['user_id'];
            $buy->status="pending";
            $buy->payment_method=$req->payment;
            $buy->payment_status="pending";
            $buy->address=$req->address;
            $buy->save();
            Cart::where('user_id',$userId)->delete(); 
        }
        $req->input();
        return redirect('/');
         
    }
    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $buys= DB::table('buys')
         ->join('products','buys.product_id','=','products.id')
         ->where('buys.user_id',$userId)
         ->get();
 
         return view('myorders',['buys'=>$buys]);
    }
}
