<?php

namespace App\Http\Controllers;

use App\vendor;
use App\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors  = Vendor::all(); // lấy toàn bộ dữ liệu
//        echo'<pre>';
//        print_r($vendors);
//        die;
        $listVendor = Vendor::latest()->paginate(10); // sắp sếp theo thứ tự mới nhất && phân trang

        return view('admin.Vendor.index',[
            'data' => $listVendor,
            'vendors' => $vendors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors  = Vendor ::all(); // lấy toàn bộ dữ liệu

        return view('admin.vendor.create',[
            'vendors' => $vendors
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate dữ liệu


        // bước 1 : nhận được data từ request
        //$name = $_POST['name'];
//        $parent_id = $request->input('parent_id'); // lấy dữ liệu từ form
        $name = $request->input('name'); // tên
        $email  = $request->input('email'); // email
        $phone = $request->input('phone'); // diện thoại
        $position = $request->input('position'); // vị trị
        $address = $request->input('address');
        $website  = $request->input('website');
        $is_active = $request->input('is_active'); // hiển thị

        // bươc 2:
        $vendor = new Vendor(); // tên bảng =>  class
//        $vendor->parent_id = $parent_id; // tên cột => thuộc tính của Class
        $vendor->name = $name;
        $vendor->email  = $email;
        $vendor->phone   = $phone ;
        $vendor->website    = $website  ;
        $vendor->slug = str_slug($name);
        $vendor->position = $position;
        $vendor->address = $address;
        $vendor ->is_active = $is_active ? $is_active : 0;

        // xử lý lưu ảnh
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // tên file image
            $filename = $file->getClientOriginalName(); // tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/vendor/'; // uploads/brand ; uploads/vendor
            // Thực hiện upload file
            $file->move($path_upload,$filename);

            $vendor->image = $path_upload.$filename;
        }

        $vendor->save();

        // bước 3 : chuyển về trang danh sách
        // header('Location: http://mvc.local:8888/?method=danhsach&controller=user');

        return redirect()->route('admin.admin.vendor.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        $vendors = Vendor::all(); // lấy toàn bộ dữ liệu

        return view('admin.vendor.edit', [
            'vendor' => $vendor,
            'vendors' => $vendors
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate dữ liệu


        // bước 1 : nhận được data từ request
        //$name = $_POST['name'];
        $name = $request->input('name'); // tên
        $email  = $request->input('email'); // email
        $phone = $request->input('phone'); // diện thoại
        $position = $request->input('position'); // vị trị
        $address = $request->input('address');
        $website  = $request->input('website');
        $is_active = $request->input('is_active'); // hiển thị

        // bươc 2:
        $vendor = Vendor::find($id); // tên bảng =>  class
        $vendor->name = $name;
        $vendor->email  = $email;
        $vendor->phone = $phone;
        $vendor->website  = $website;
        $vendor->slug = str_slug($name);
        $vendor->position = $position;
        $vendor->address = $address;
        $vendor ->is_active = $is_active ? $is_active : 0;


        // xử lý lưu ảnh
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // tên file image
            $filename = $file->getClientOriginalName(); // tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/vendor/'; // uploads/brand ; uploads/vendor
            // Thực hiện upload file
            $file->move($path_upload,$filename);

            $vendor->image = $path_upload.$filename;
        }

        $vendor->save();

        // bước 3 : chuyển về trang danh sách
        // header('Location: http://mvc.local:8888/?method=danhsach&controller=user');

        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendor::destroy($id); // DELETE FROM categories WHERE id = 56

        return response()->json(['status' => true], 200);
    }
}
