<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders(){
        return view('backend.order.order');
    }
    public function ordersdetail(){
        return view('backend.order.detailorder');
    }

    public function process(){
        return view('backend.order.processed');
    }
}
