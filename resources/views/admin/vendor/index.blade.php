@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            QL Nhà Cung Cấp
            <a href="{{ route('admin.vendor.create') }}" class="btn btn-primary">Thêm Nhà Cung Cấp</a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" >
                        <table class="table table-hover">
                            <tr>
                                <th style="width: 10px">STT</th>
                                <th class="text-center">Tên NCC </th>
                                <th class="text-center">EMAIL </th>
                                <th class="text-center">Điện Thoại </th>
                                <th class="text-center">Ảnh </th>
                                <th class="text-center">WebSite </th>
                                <th class="text-center">Vị Trí </th>
                                <th class="text-center">Trạng Thái </th>
                                <th class="text-center">Hành Động  </th>
                            </tr>
                            @foreach($data as $index => $item)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td class="text-center">{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->email }}</td>
                                    <td class="text-center">{{ $item->phone }}</td>
                                    <td class="text-center">
                                        @if($item->image)
                                            <img width="100" src="{{ asset($item->image) }}">
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->website }}</td>
                                    <td class="text-center">{{ $item->position}}</td>
                                    <td class="text-center">
                                        {!! ($item->is_active == 1) ? '<span class="badge bg-green"> hiển thị </span>' : '<span class="badge bg-red">ẩn</span>'  !!}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.vendor.edit', ['id' => $item->id]) }}" class="btn btn-primary ">
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
                    <div class="box-footer clearfix">
                        {{ $data->links() }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>

    </section>
    <!-- /.content -->
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
                        url: './vendor/'+id,
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
