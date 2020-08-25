<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function cart(){
        echo "Đây là trang giỏ hàng";
    }
    public function checkout(){
        echo "Đây là trang thanh toán";
    }
    public function complete(){
        echo "Đây là trang thông báo thanh toán thành công";
    }
}
