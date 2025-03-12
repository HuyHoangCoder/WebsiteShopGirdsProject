<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function cart(){
        
        return view('product.cart');
    }
    public function checkout(Request $request){
        $order= new Order();
        $order->user_id = (Auth::check()) ? Auth::user()->id : null;
        $order->user_fullname = $request->fullname;
        $order->user_email = $request->email;
        $order->user_phone = $request->phone;
        $order->user_address = $request->address;
        $order->total_money = 0;
        $order->total_quantity = 0;
        $order->save();

        foreach(session('cart') as $sp){
            $order_detail= new OrderDetail();
            $order_detail->product_id=$sp->id;
            $order_detail->order_id=$order->id;
            $order_detail->price = is_null($sp->save_price)? $sp->price : $sp->sale_price;
            $order_detail->quantity = $sp->quantity;
            $order_detail->save();

            $order->total_money += $order_detail->quantity*$order_detail->price;
            $order->total_quantity += $order_detail->quantity;
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inCart = false;
        // kiểm tra giỏ hàng có chưa
        if(is_null(session('cart'))){
            session()->put('cart', []);
        }
        foreach(session('cart') as $sp){
            if ($sp->id == $request->product_id) {
                // đã có sp trong giỏ -> tăng số lượng
                $sp->quantity +=$request->quantity;
                $inCart=true;
                break;
            }
        }
        if (!$inCart) {
            // chưa có sp trong giỏ -> thêm sp 
            $sp = Product::find($request->product_id);
            $sp->quantity +=$request->quantity;
            session()->push('cart', $sp);
        }

        $kq =[
            'status'=>true,
            'message'=>'Da them san pham',
            'data'=>session('cart'),
        ];
        return response()->json($kq, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        foreach(session('cart') as $sp){
            if($sp->id == $id){
                $sp->quantity = ($request->quantity > $sp->instock) ? $sp->instock:$request->quantity;
            }
        }
        $kq =[
            'status'=>true,
            'message'=>'Da cap nhat gio hang',
            'data'=>session('cart'),
        ];
        return response()->json($kq, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        // session()->pull('cart.'.$id); // id ở đây là index
        $cart= session('cart');
        array_splice($cart, $id, 1);
        session()->forget('cart');
        session()->put('cart', $cart);
        $kq =[
            'status'=>true,
            'message'=>'Da them san pham',
            'data'=>session('cart'),
        ];
        return response()->json($kq, 200);
    }
}
