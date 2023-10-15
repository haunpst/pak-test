<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tbl_Product;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function genCode()
    {
        $count = tbl_Product::count() + 1;
        return 'SP' . str_pad($count, 5, '0', STR_PAD_LEFT);
    }

    public function index($categoryId = null)
    {
        $query = tbl_Product::query();
        if ($categoryId)
            $query->where('category_id', $categoryId);
        $data = $query->paginate(10);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required|integer',
            'unit' => 'required',
            'category_id' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'price.required' => 'Giá sản phẩm là bắt buộc.',
            'price.integer' => 'Giá sản phẩm phải là kiểu số.',
            'unit.required' => 'Đơn vị tính là bắt buộc.',
            'category_id.required' => 'Nhóm sản phẩm là bắt buộc.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            try {
                $code = $request->code != null ? $request->code : $this->genCode();
                $data = new tbl_Product();
                $data->code = $code;
                $data->price = $request->price;
                $data->name = $request->name;
                $data->unit = $request->unit;
                $data->category_id = $request->category_id;
                $data->description = $request->description;
                $data->save();
                return response()->json(['success' => 'Thêm sản phẩm mới thành công!']);
            } catch (\Throwable $e) {
                return response()->json(['error' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại!']);
            }

        }
    }
}
