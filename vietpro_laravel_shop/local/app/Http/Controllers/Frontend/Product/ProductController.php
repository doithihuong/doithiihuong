<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function shop(){
        echo "Đây là trang sản phẩm";
    }

    public function detail(){
        echo "Đây là trang chi tiết sản phẩm";
    }
}
