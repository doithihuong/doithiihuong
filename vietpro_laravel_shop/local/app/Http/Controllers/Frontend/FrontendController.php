<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        echo "Đây là trang index Frontend";
    }

    public function about(){
        echo "Đây là trang giới thiệu";
    }
    
    public function contact(){
        echo "Đây là trang liên hệ";
    }
}
