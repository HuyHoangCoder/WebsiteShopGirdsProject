<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::insert([
            [
                'user_id'=>2,
                'product_id'=>1,
                'content'=>'điện thoại xịn',
                'rating'=>5,
                'created_at'=>now(),
            ],
            [
                'user_id'=>2,
                'product_id'=>1,
                'content'=>'điện thoại mắc quá',
                'rating'=>4,
                'created_at'=>now(),
            ],
            [
                'user_id'=>2,
                'product_id'=>1,
                'content'=>'Đồ cùi',
                'rating'=>1,
                'created_at'=>now(),
            ],
        ]);
    }
}
