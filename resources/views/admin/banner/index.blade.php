@extends('admin.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
            Danh Sách Banner <a href="{{route('admin.banner.create')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Thêm Banner</a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
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
                                <th class="text-center">STT</th>
                                <th class="text-center">Tiêu đề</th>
                                <th class="text-center">Hình ảnh</th>
                                <th class="text-center">Target</th>
                                <th class="text-center">Loại</th>
                                <th class="text-center">Vị trí</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($data as $key => $item)
                                <tr class="text-center" class="item-{{ $item->id }}"> <!-- Thêm Class Cho Dòng -->
                                    <td>{{ $key }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        @if($item->image)
                                            <img width="100" src="{{ asset($item->image) }}">
                                        @endif
                                    </td>
                                    <td>{{ ($item->target == 1) ? '_blank' : '_self' }}</td>
                                    <td>{{ ($item->type == 1) ? 'slide' : 'background' }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td class="text-center">
                                        {!! ($item->is_active == 1) ? '<span class="badge bg-green"> hiển thị </span>' : '<span class="badge bg-red">ẩn</span>'  !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.banner.edit', ['id' => $item->id]) }}" class="btn btn-primary ">
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
                        url: './banner/'+id,
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
