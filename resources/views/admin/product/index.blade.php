@extends('admin.layouts.main')
@section('content')
    <style>tr td:first-child {max-width: 250px}</style>
    <section class="content-header">
        <h1>
            Danh Sách Sản Phẩm <a href="{{route('admin.product.create')}}" class="btn btn-flat btn-info"> Thêm Sản Phẩm</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                {{--                        Tìm Kiếm--}}
                {{--                    <div class="box-header">--}}
                {{--                        <div class="box-tools">--}}
                {{--                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">--}}
                {{--                                <input type="text" name="table_search" class="form-control pull-right"--}}
                {{--                                       placeholder="Search">--}}

                {{--                                <div class="input-group-btn">--}}
                {{--                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>STT</th>
                                <th style="max-with:200px">Tên SP</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá KM</th>
                                <th>Giá Gốc</th>
                                <th>Sản phẩm Hot</th>
                                <th>Trạng thái</th>
                                <th>Người tạo</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($data as $key => $item)
                                <tr class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $key }}</td>
                                    <td>{{ substr($item->name, 0, 50) }}</td>
                                    <td>
                                        @if($item->image)
                                            <img width="100" src="{{ asset($item->image) }}">
                                        @endif
                                    </td>
                                    <td>{{ $item->stock }}</td>
                                    <td>{{ $item->sale }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ ($item->is_hot == 1) ? 'Có' : 'Không' }}</td>
                                    <td class="text-center">
                                        {!! ($item->is_active == 1) ? '<span class="badge bg-green"> hiển thị </span>' : '<span class="badge bg-red">ẩn</span>'  !!}
                                    </td>
                                    <td>{{ isset($item->user->name) ?  $item->user->name : ''}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.product.edit', ['id' => $item->id]) }}" class="btn btn-primary ">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a type="button" class="btn btn-danger btnDelete" data-id="{{$item-> id}}">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
                {{ $data->links() }}
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('my_js')
    <script type="text/javascript">
        $(document).ready(function() {
            // đính kèm token vào mỗi request ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // suAbidEneUPjfI5mHvWdFbSQ1PsM4OYSm73vF7kZ
                }
            });
            $('.btnDelete').click(function () {
                var id = $(this).attr('data-id'); // lấy thuộc tính của thẻ HTML
                var me = this;
                var result = confirm("Bạn có chắc chắn muốn xóa ?");
                if (result == true) { // neu nhấn == ok , sẽ send request ajax
                    $.ajax({
                        url: './product/'+id,
                        type: 'DELETE', // method
                        data: {}, // dữ liệu truyền sang nếu có
                        dataType: "json", // kiểu dữ liệu nhận về
                        success: function (res) { // success : kết quả trả về sau khi gửi request ajax
                            if (res.status == true) {
                                $(me).closest('tr').remove();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
