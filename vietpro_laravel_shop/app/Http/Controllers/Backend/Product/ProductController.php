<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Menu;
class ProductController extends Controller
{
    public function index(){
        //$products = Product::all();
        $products = Product::paginate(5);
        $menu = Menu::new([
            Link::to(route('admin.index'), 'Tổng Quan'),
            Link::to(route('category.index'), 'Danh Mục'),
            Link::to(route('product.index'), 'Sản Phẩm'),
            Link::to(route('order.index'), 'Đơn Hàng'),
            Link::to(route('user.index'), 'Quản Lý Thành Viên'),
        ]);
        $data['menu'] = $menu;
        $data['products'] = $products;
        return view('backend.product.listproduct', $data);
      //  return view('backend.product.listproduct',compact('products'));
    }
    public function create(){
        $categories = Category::all();
        return view('backend.product.addproduct',compact('categories'));
    }
    public function store(AddProductRequest $request){
        
        // dd($request->hasFile('img'));
        $product = new Product;
        $product->category_id = $request->category;
        $product->code = $request->code;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name,'-');
        $product->price = $request->price;
        $product->featured = $request->featured;
        $product->state = $request->state;
        $product->info = $request->info;
        $product->description = $request->describe;
        // print_r($request->all());
        
        if($request->hasFile('img')){
         
            $file= $request->img;
            $file_name = Str::slug($product->name,'_').'.'.$file->getClientOriginalExtension();
            // upload ảnh lên server
            $path = public_path().'/uploads';
            $file->move($path,$file_name);
            // lưu tên vào csdl
            $product->img = $file_name;
        }else{
            $product->img = 'no-img.jpg';
        }
        $product->save();
        return redirect()->route('product.index')->with('success','Thêm sản phẩm thành công');
    }
    public function edit($id){
        $theloai = Category::all();
        $products = Product::find($id);
        return view('backend.product.editproduct', compact('products','theloai'));
    }
    public function updateproduct(Request $request, $id){
        // print_r($request->all());
        $product= Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->slug = Str::slug($request->name,'-');
        $product->price = $request->price;
        $product->featured = $request->featured;
        $product->state = $request->state;
        $product->info = $request->info;
        $product->description = $request->describe;
       //ProductController.php $product->img = $request->img;
        if ($request->img&&$request->img!=null) {
            if ($request->hasFile('img')) {

                // print_r('<br>'. 'jhdhshfhd' .'<br>');
                $file = $request->file('img');
                $formatImg = $file->getClientOriginalExtension();
                if ($formatImg != 'jpg' && $formatImg != 'png' && $formatImg != 'jpeg') {
                    return "Định dạng file không hợp lệ. Vui lòng chọn file ảnh";
                    // return redirect()->back()->with('thongbao', "Định dạng của ảnh không hợp lệ");
                }
                $name = $file->getClientOriginalName();
                
                while (file_exists('/uploads' . $name)) {
                    $name = str_random(4) . "_" . $name;
                }
                //Chỗ này
                $file->move(public_path().'\uploads', $name);
                // print_r($name. public_path() . '<br>');
                $product->img = $name;
            }
        }
        // print_r($product);
        $product->save();
        // return $product;
        
        return redirect('admin/product')->with('success','Đã sửa sản phẩm thành công');
    } 
    public function delete($id){
        $products= Product::find($id);
        $products = Product::all();
        foreach ($products as $key => $value) {
            if($value['id']== $id){
                $value->delete();
            }
        }
        // $products->delete();
        return redirect()->back()->with('success','Đã xóa san pham thành công');
    }
}
