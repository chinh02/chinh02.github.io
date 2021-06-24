<?php

namespace App\Http\Controllers;

use App\Article;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $numOrder = Order::count();
        $numArticle = Article::count();
        $numProduct = Product::count();
        $numUser = User::count();

        return view('admin.dashboard', [
            'numOrder' => $numOrder,
            'numArticle' => $numArticle,
            'numProduct' => $numProduct,
            'numUser' => $numUser
        ]);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        //validate du lieu
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        $data = [
            'email' => trim($request->input('email')),
            'password' => trim($request->input('password'))
        ];


        // check success
        if (Auth::attempt($data, $request->has('remember'))) { //check đăng nhập
            //SELECT * FROM user WHERE email ='.....' and password='.....'
            return redirect()->route('admin.product.index');
        }

        return redirect()->back()->with('msg', 'Email hoặc Password không chính xác');;
    }

    public function logout()
    {
        Auth::logout();
        // chuyển về trang đăng nhập
        return redirect()->route('admin.login');
    }
}
