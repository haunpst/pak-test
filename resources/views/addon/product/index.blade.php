@extends('layouts.app')

@section('title')
    Danh sách sản phẩm
@endsection

@section('css-private')

@endsection

@section('content')
    <a class="btn btn-primary float-end mb-3 mt-3" href="{{route('product.store')}}" role="button">
        <i class="bi bi-plus-lg"></i> Thêm mới
    </a>
    <table class="table text-center table-striped">
        <thead>
        <tr>
            <th scope="col">Tên</th>
            <th scope="col">Nhóm</th>
            <th scope="col">Giá</th>
            <th scope="col">Đơn vị tính</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Ngày sửa</th>
            <th scope="col">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->name}}</td>
                <td>{{$i->category->name}}</td>
                <td>{{number_format($i->price)}}</td>
                <td>{{$i->unit}}</td>
                <td>{{date_format($i->created_at, 'd/m/Y')}}</td>
                <td>{{date_format($i->updated_at, 'd/m/Y')}}</td>
                <td>
                    <button class="btn delete-product" data-id="{{ $i->id }}">
                        <i class="bi bi-trash3 text-danger"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js-private')
    <script>
        $(document).ready(function () {
            $(".delete-product").on("click", function () {
                let $this = $(this);
                if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
                    let productId = $this.data("id");
                    $.ajax({
                        url: "/product/delete/" + productId,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $this.closest("tr").remove();
                        },
                        error: function (data) {
                            alert("Có lỗi xảy ra khi xóa sản phẩm.");
                        }
                    });
                }
            });
        });
    </script>
@endsection
