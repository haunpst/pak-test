@extends('layouts.app')

@section('title')
    Thêm sản phẩm
@endsection

@section('css-private')
@endsection

@section('content')
    <div class="col-12">
        <div class="row pt-3 pb-2 bg-light">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('product.list')}}">Danh sách sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
                    </ol>
                </nav>
            </div>
            <div class="col-6 text-end">
                <button type="button" id="btn-submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Lưu</button>
                <button type="button" id="btn-submit-create" class="btn btn-primary"><i class="bi bi-floppy2"></i> Lưu & Tạo</button>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <form action="{{route('product.store.post')}}" method="post" class="needs-validation" novalidate>
            @csrf
            <input hidden value="0" type="number" name="creating" id="creating">
            <div class="row">
                <div class="col-12">
                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="code" class="form-label">Mã sản phẩm</label>
                            <input type="text" class="form-control" id="code" name="code"
                                   placeholder="Nhập mã sản phẩm">
                        </div>
                        <div class="col-6">
                            <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required
                                   placeholder="Nhập tên sản phẩm">
                            <div class="invalid-feedback">
                                Vui lòng nhập tên sản phẩm.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="category" class="form-label">Nhóm sản phẩm <span
                                        class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="">--- Chọn nhóm sản phẩm ---</option>
                                @foreach($category as $i)
                                    <option value="{{$i->id}}">{{$i->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn loại sản phẩm.
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="unit" class="form-label">Đơn vị tính <span class="text-danger">*</span></label>
                            <select name="unit" id="unit" class="form-select" required>
                                <option value="">--- Chọn đơn vị tính ---</option>
                                <option value="Cái">Cái</option>
                                <option value="Hộp">Hộp</option>
                                <option value="Thùng">Thùng</option>
                            </select>
                            <div class="invalid-feedback">
                                Vui lòng chọn đơn vị tính.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label for="price" class="form-label">Giá sản phẩm <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="price" name="price" required
                                   placeholder="Nhập giá sản phẩm">
                            <div class="invalid-feedback">
                                Vui lòng nhập giá sản phẩm.
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <label for="description" class="form-label">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                      placeholder="Nhập mô tả về sản phẩm"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js-private')
    <script>
        $(document).ready(function () {
            $("#price").on('keyup', function (evt) {
                console.log($(this).val());
                if (evt.which !== 110) {
                    if (!isNaN(parseFloat($(this).val().replace(/\,/g, ''), 10))) {
                        var n = parseFloat($(this).val().replace(/\,/g, ''), 10);
                        $(this).val(n.toLocaleString());
                    } else {
                        $(this).val('')
                    }
                }
            });

            const forms = $('.needs-validation');

            forms.each(function (index, form) {
                $(form).on('change', function (event) {
                    if (form.checkValidity()) {
                        $('#btn-submit').prop('disabled', false);
                        $('#btn-submit-create').prop('disabled', false);
                    }
                });

                $(form).on('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });

            $('#btn-submit').on('click', function () {
                $('#creating').val('0')
                forms.submit()
            })

            $('#btn-submit-create').on('click', function () {
                $('#creating').val('1')
                forms.submit()
            })
        })
    </script>
@endsection
