<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\cart;
use App\Models\order;
use Session;
use Redirect;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function index(){
        $data =  Product::all();
        return view('Product',['products'=>$data]);
    }

    function detail($id){
        $data = Product::find($id);
        return view('detail',['product'=>$data]);
    }
    
    function addtocart(Request $req){
        if($req->session()->has('user')){
            $cart = new cart;
            $cart->product_id = intval($req->product_id);
            $cart->user_id = intval($req->session()->get('user')['id']);
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/login');
        }
    }

    function addtobuy(Request $req){
        if($req->session()->has('user')){
            $cart = new cart;
            $cart->product_id = intval($req->product_id);
            $cart->user_id = intval($req->session()->get('user')['id']);
            $cart->save();
            return redirect('/cartlist');
        }
        else{
            return redirect('/login');
        }
    }
    

    function cartitem(){
        $userId = Session::get('user')['id'];
        return cart::where('user_id',$userId)->count(); 
    }
    
    function cartList(){
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();

        return view('cartlist',['products'=>$products]);
    }

    function removeCart($id){
        cart::destroy($id);
        return redirect('/cartlist');
    }

    function buynow(Request $req){
        $userId = Session::get('user')['id'];
        $total = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('products.price');

        $products = DB::table('cart')
        ->where('cart.user_id',$userId)
        ->get();

        if( $req->path() == "ordernow" && count($products)<1){
            return back();
        }
        return view('ordernow',['total'=>$total]);
    }

    function orderplaced(Request $req){

        $validator = Validator::make($req->all(),[
            'address' =>'required',
            'payment' =>'required',
        ]);

        if($validator->passes()){
            $userId = Session::get('user')['id'];
            $allcart = cart::where('user_id',$userId)->get();
            foreach($allcart as $cart){
                $order = new order;
                $order->product_id = $cart['product_id'];
                $order->user_id = $cart['user_id'];
                $order->status = "pending";
                $order->payment_method = $req->payment;
                $order->product_status = 'pending';
                $order->address = $req->address;
                $order->save();
                cart::where('user_id',$userId)->delete();
            }
            return response()->json(['success' => 'Sucessfully Ordered']);
        }
        else{
            return response()->json(['error' => $validator->errors()]);
        }
    }

    function myOrders(){
        $userId = session::get('user')['id'];
        $myorders = DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userId)
        ->get();

        return view('myorders',['myorders'=>$myorders]);
        // return view('myorders');
    }
    
    function search(Request $req)
    {
        
        if($req->ajax()){

            $data = Product::where('name','LIKE','%'.$req->name.'%')->get();
            $output='';
            
            if( count($data) > 0 ){
                foreach($data as $row){ 
                    $num = $row->id;
                        $output .= '<a href="detail/'.$num.'"><li class="dropdown-item" style="text-align: center;padding: 5px;">'.$row->name.'</li></a>';
                }
            }else{
                $output .= '<li class="dropdown-item"> No data Found </li>';
            }
            return $output;
        }
        return view('/');
    }

}
