@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sửa Danh Mục <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Danh Sách</a>
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
                        <h3 class="box-title">Thông tin</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form"  method="POST" action="{{ route('admin.category.update',['id' => $category->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label>Danh Mục Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">-- Chọn --</option>
                                    @foreach($categories as $cate)
                                        <option {{ $category->parent_id == $cate->id ? 'selected' : '' }} value="{{ $cate->id }}">{{ $cate->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên</label>
                                <input value="{{ $category->name }}" name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <input type="file" id="exampleInputFile" name="image">
                                <img width="100" src="{{ asset($category->image) }}" alt="">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Vị trí</label>
                                <input value="{{ $category->position }}" name="position" type="number" class="form-control" id="exampleInputEmail1" value="1">
                            </div>

                            <div class="form-group">
                                <label>Loại Danh Mục</label>
                                <select class="form-control" name="type">
                                    <option {{ $category->type == 1 ? 'selected' : '' }} value="1">Sản Phẩm</option>
                                    <option {{ $category->type == 2 ? 'selected' : '' }} value="2">Tin Tức</option>
                                    <option {{ $category->type == 3 ? 'selected' : '' }} value="3">Khác</option>
                                </select>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_active" {{ $category->is_active == 1 ? 'checked' : '' }} > Hiển thị
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
