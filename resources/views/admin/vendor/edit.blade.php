@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa Danh Mục <a href="{{ route('admin.vendor.index') }}" class="btn btn-primary">Danh Sách</a>
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
                        <h3 class="box-title">Thông tin Nhà Cung Cấp</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  method="POST" action="{{ route('admin.vendor.update',['id' => $vendor->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Nhà Cung Cấp</label>
                                <input value="{{ $vendor->name }}" name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email  </label>
                                <input value="{{ $vendor->email }}" name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập email ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số Điện Thoại   </label>
                                <input value="{{ $vendor->phone }}" name="phone" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại  ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <input type="file" id="exampleInputFile" name="image">
                                <img width="100" src="{{ asset($vendor->image) }}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Website </label>
                                <input  value="{{ $vendor->website }}" name="website" type="text " class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa Chỉ  </label>
                            </div>
                            <div class="form-group">
                                <textarea type="text " name="address" rows="4" cols="50">{{ $vendor->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vị trí</label>
                                <input value="{{ $vendor->position }}" name="position" type="number" class="form-control" id="exampleInputEmail1" value="1">
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_active" {{ $vendor->is_active == 1 ? 'checked' : '' }} > Hiển thị
                                </label>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
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
