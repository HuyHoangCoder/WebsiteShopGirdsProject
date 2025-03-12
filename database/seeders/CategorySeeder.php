<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name'=>'Điện Thoại'],
            ['name'=>'Máy Tính'],
            ['name'=>'Máy Tính Bảng'],
            ['name'=>'Đồng Hồ Thông Minh'],
            ['name'=>'Phụ Kiện']
        ]);
    }
}
