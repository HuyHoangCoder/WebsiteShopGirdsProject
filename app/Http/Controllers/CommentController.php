<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function product($product_id){
        $dsBL=Comment::where('product_id', $product_id)
        ->join('users', 'user_id', '=', 'users.id')
        ->select('comments.*', 'users.name AS user_fullname')
        ->get();
        $kq=[
            'status'=>true,
            'message'=>'lấy dữ liệu thành công',
            'data'=>$dsBL,
        ];
        return response()->json($kq, 200);
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
        $comment = new Comment();
        $comment->user_id = Auth:: user()->id;
        $comment->product_id = $request->product_id;
        $comment->content = $request->content;
        $comment->rating = $request->rating;
        $comment->save();
        $kq = [
        'status'=>true,
        'message' => 'Đã thêm bình luận!',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
