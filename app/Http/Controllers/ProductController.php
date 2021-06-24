<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::latest()->paginate(20);

        return view('admin.product.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); // SELECT * FROM categories
        $vendors = Vendor::all(); // SELECT * FROM venders

        return view('admin.product.create', [
            'categories' => $categories,
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
        //validate dữ liệu, xử lý lỗi
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ],[
            'name.required' => 'Bạn chưa nhập tên',
            'image.mimes' => 'Ảnh lỗi định dạng'
        ]);//nếu có lỗi sẽ return back URL create, kèm theo một danh sách lỗi lưu vào biến $erros

        $product= new Product(); // tên bảng =>  class

        $product->stock= $request->input('stock'); // số lượng
        $product->price = $request->input('price'); // giá bán
        $product->sale = $request->input('sale'); // giá khuyến mại
        $product->category_id  = $request->input('category_id');
        $product->vendor_id = $request->input('vendor_id');
        $product->sku = $request->input('sku');
        $product->position = $request->input('position');
        $product->url = $request->input('url');
        $product->name = $request->input('name');
        $product->slug = str_slug($request->input('name'));

        $is_active = $request->input('is_active'); // hiển thị
        //kiem tra is_active co ton tai khong
        $product->is_active = $is_active ? $is_active : 0;

        // Upload file
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // tên file image
            $filename = $file->getClientOriginalName(); // tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/product/'; // uploads/brand ; uploads/vendor
            // Thực hiện upload file
            $file->move($path_upload, $filename);

            $product->image = $path_upload . $filename;
        }

        // Sản phẩm Hot
        if ($request->has('is_hot')){
            $product->is_hot = $request->input('is_active');
        }

        $product->summary = $request->input('summary');
        $product->description = $request->input('description');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->save();

// chuyển hướng đến trang
        return redirect()->route('admin.product.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get data from db
        $data = Product::findorFail($id);
        $category_name = Category::where('id', $data->category_id)->first();

        return view('admin.product.show', [
            'data' => $data,
            'category_name' => $category_name
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::findorFail($id);
        $categories = Category::all();
//        $brands = Brand::all();
        $vendors = Vendor::all();

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
//            'brands' => $brands,
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
        //validate dữ liệu, xử lý lỗi
        $validatedData = $request->validate([
            'name' => 'required|max:255',
//            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ],[
            'name.required' => 'Bạn chưa nhập tên',
//            'image.mimes' => 'Ảnh lỗi định dạng'
        ]);//nếu có lỗi sẽ return back URL create, kèm theo một danh sách lỗi lưu vào biến $erros

        $product = Product::find($id); // tên bảng =>  class

        $product->stock= $request->input('stock'); // số lượng
        $product->price = $request->input('price'); // giá bán
        $product->sale = $request->input('sale'); // giá khuyến mại
        $product->category_id  = $request->input('category_id');
        $product->vendor_id = $request->input('vendor_id');
        $product->sku = $request->input('sku');
        $product->position = $request->input('position');
        $product->url = $request->input('url');
        $product->name = $request->input('name');
        $product->slug = str_slug($request->input('name'));

        $is_active = $request->input('is_active'); // hiển thị
        //kiem tra is_active co ton tai khong
        $product->is_active = $is_active ? $is_active : 0;

        // Upload file
        if ($request->hasFile('image')) { // dòng này Kiểm tra xem có image có được chọn
            // get file
            $file = $request->file('image');
            // tên file image
            $filename = $file->getClientOriginalName(); // tên ban đầu của image
            // Định nghĩa đường dẫn sẽ upload lên
            $path_upload = 'uploads/product/'; // uploads/brand ; uploads/vendor
            // Thực hiện upload file
            $file->move($path_upload, $filename);

            $product->image = $path_upload . $filename;
        }

        // Sản phẩm Hot
        if ($request->has('is_hot')){
            $product->is_hot = $request->input('is_active');
        }

        $product->summary = $request->input('summary');
        $product->description = $request->input('description');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->save();

// chuyển hướng đến trang
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        Product::destroy($id); // DELETE FROM categories WHERE id = 56

        return response()->json(['status' => true], 200);
    }
}
