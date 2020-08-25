<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
//use App\Models\Product;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Menu;
class UserController extends Controller
{
    public function index(){
        $users = User::paginate(2);
        $menu = Menu::new([
            Link::to(route('admin.index'), 'Tổng Quan'),
            Link::to(route('category.index'), 'Danh Mục'),
            Link::to(route('product.index'), 'Sản Phẩm'),
            Link::to(route('order.index'), 'Đơn Hàng'),
            Link::to(route('user.index'), 'Quản Lý Thành Viên'),
        ]);
        $data['menu'] = $menu;
        $data['users'] = $users;
        return view('backend.user.listuser',$data);
       // return view('backend.user.listuser',compact('users'));
    }
    public function create(){
       return view('backend.user.adduser');
       
    }
    public function store(AddUserRequest $request){
        // 'password' => Hash::make($request->newPassword)
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->full_name = $request->full_name;
        $user->level = $request->level;

        $user->save();

        return redirect()->route('user.index')->with('success','Thêm người dùng thành công');
    }
    public function edit($id){
        $users= User::find($id);
        return view('backend.user.edituser', compact('users'));

    }
    public function update(Request $request, $id){// cái này là Request
        $user= User::find($id);
        // return ($request->all());
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->full_name = $request->full_name;
        $user->level = $request->level;
        $user->save();

        return redirect('admin/user')->with('success','Đã sửa nguoi dung thành công');


    }
    public function delete($id){
        // $user= User::find($id);
        $user= User::all();
        //return($user);
        // print_r($user);
        foreach ($user as $key => $value) {
            if($value['id']== $id){
                $value->delete();
            }
        }
        // $user->delete();
        return redirect()->back()->with('success','Đã xóa nguoi dung thành công');
        
    }
}
