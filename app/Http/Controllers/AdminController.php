<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $soDonHang = Order::count();
        $soSanPham = Product::count();
        $soKhachHang = User::where('role', 'user')->count();


        $dsDH = Order::orderBy('created_at', 'DESC')->limit(5)->get();
        $dsBL = Comment::orderBy('created_at', 'DESC')->limit(5)->get();

        $tkDoanhThu = Order::groupByRaw('YEAR(created_at), MONTH(created_at)')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_money) as total')
        ->orderBy('year', 'ASC')->orderBy('month', 'ASC')->get();

        return view('admin.dashboard', 
        compact('soDonHang', 'soSanPham', 'soKhachHang', 'dsDH', 'dsBL', 'tkDoanhThu'));
    }
}
