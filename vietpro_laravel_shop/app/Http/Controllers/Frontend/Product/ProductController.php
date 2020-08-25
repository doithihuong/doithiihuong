<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;


class ProductController extends Controller
{
    public function shop(){
       $data['products'] = Product::paginate(5);
       $data['categories'] = Category::all();
    
        return view('Frontend.product.shop',$data);
    }
    public function timkiem($cate){
        $categories= Category::all();
        $products = Product::where('category_id',$cate)->paginate(6);
        return view('Frontend.product.shop',compact('products','categories'));
    }
    public function timkiemtheokhoanggia(Request $req){
        $categories= Category::all();
        $gia_min = $req->start;
        $gia_max = $req->end;
        $products = Product::paginate(6);
        if($gia_min){
            $products = Product::where('price','>=',$gia_min)->paginate(6);
        }
        if($gia_max){
            $products = Product::where('price','<=',$gia_max)->paginate(6);
        }
        return view('Frontend.product.shop',compact('products','categories','gia_min','gia_max'));
    }
    public function filter(Request $request ){
      $data['products'] = Product::where('price','>', $request->start)->where('price','<',$request->end)->paginate(6);
       //$data['products'] = Product::whereBetween('price', [$request->start, $request->end])->paginate(2);
       $data['products']->appends(['start' => $request->start,'end' => $request->end]);
       $data['categories'] = Category::all(); 
        return view('Frontend.product.shop',$data);
    }
    public function detail( $slug_product ){
        $newest_prd = Product::orderBy('id','desc')->take(4)->get();
       // $newest = $newest_prd;
        $data['newest'] = $newest_prd;
       // $product = Product::where('slug',$slug_product)->first();
        $data['product'] = Product::where('slug',$slug_product)->first();
       // return view('frontend.product.detail', compact('product','newest'));
       return view('Frontend.product.detail', $data);
    }
}
