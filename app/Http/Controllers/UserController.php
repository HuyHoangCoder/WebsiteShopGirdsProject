<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // đăng nhâp
    public function login(){ // đổ ra view
        return view('User.Login');
    }

    public function postLogin(Request $request){
        $email = $request->input('email'); //khai báo $email lấy từ input name='email'
        $pass = $request->input('pass');
        $remember = $request->input('remember');

        $user = User::where('email', $email)->first();
        $canLogin = false;
        if (isset($user)) {
            $canLogin = Hash::check($pass, $user->password);
        }
        if ($canLogin) { // cho phép đăng nhập
            Auth::login($user, $remember);
            return redirect()->route('home');
        }
        else{
            session()->put('messenger', 'Email hoặc mật khẩu không đúng !');
            return back(); // dùng để quay về lại trang 
        }
    }



    // Đăng Ký 
    public function register(){ // đổ ra view
        return view('User.Register');
    }

    public function postRegister(Request $request){ // xử lý giữ liệu để thực hiện đăng ký

        $email = $request->input('email'); //khai báo $email lấy từ input name='email'
        $name = $request->input('name'); 
        $password = $request->input('password'); 
        $repassword = $request->input('repassword'); 

        if ($password!=$repassword) { // nếu password khác 
            session()->put('messenger', 'Mật khẩu của bạn không trùng khớp');
            return back(); // dùng để quay về lại trang 
        }

        $user = User::where('email', $email)->first(); 
        // $user trong model User vào email trong database chỉ lấy cái đầu còn k sẽ trả về null
        if (isset($user)) {
            session()->put('messenger', 'Email đã tồn tại !');
            return back(); // dùng để quay về lại trang 
        }
        
        $user = new User(); // tạo $user lấy từ User trong model
        $user->name = $name;
        $user->email = $email; // trong user lấy email từ $email ở phía trên 
        $user->password = $password;
        
        $user->save(); // sau khi lấy xong lưu lại 

        return redirect()->route('login');
    }
}
