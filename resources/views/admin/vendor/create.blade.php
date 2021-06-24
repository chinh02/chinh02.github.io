@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm Nhà Cung Cấp <a href="{{ route('admin.vendor.index') }}" class="btn btn-primary">Danh Sách</a>
        </h1>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin Nhà cung cấp </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  method="POST" action="{{ route('admin.vendor.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Nhà Cung Cấp </label>
                            <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email  </label>
                            <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập email ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Điện Thoại   </label>
                            <input name="phone" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại  ">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh </label>
                            <input type="file" id="exampleInputFile" name="image">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Website </label>
                            <input name="website" type="text " class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa Chỉ  </label>
                        </div>
                        <div class="form-group">
                            <textarea id="address " name="address" rows="4" cols="50"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vị trí</label>
                            <input name="position" type="number" class="form-control" id="exampleInputEmail1" value="1">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="1" name="is_active"> Hiển thị
                            </label>
                        </div>

                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
