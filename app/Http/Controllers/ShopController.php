<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    //trang chủ
    public function index()
    {
        return view('shop.index');
    }
    //trang liên hệ
    public function contact()
    {
        return view('shop.contact');
    }
    //trang danh sách sản phẩm
    public function listProducts()
    {
        return view('shop.list-products');

    }

    //trang sản phảm chi tiết
    public function detailProduct()
    {
        return view('shop.detail-product');
    }

    //trang danh sách  tin tức
    public function listArticles()
    {

    }

    //Trang chi tiết tin tức
    public function checkOut()
    {
        return view('shop.checkout');
    }

    //Trang giỏ hàng
    public function cart()
    {
        return view('shop.cart');
    }
}
