<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\tbl_Category;
use App\Models\tbl_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function genCode()
    {
        $count = tbl_Product::count() + 1;
        return 'SP' . str_pad($count, 5, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $data = tbl_Product::with('category')->get()->sortBy('category.name');
        return view('addon.product.index', compact('data'));
    }

    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $price = str_replace(',', '', $request->price);
                $request->merge(['price' => $price]);
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

                if ($validator->fails())
                    return redirect()->back()->withErrors($validator->errors());

                $code = $request->code != null ? $request->code : $this->genCode();
                $data = new tbl_Product();
                $data->code = $code;
                $data->price = $price;
                $data->name = $request->name;
                $data->unit = $request->unit;
                $data->category_id = $request->category_id;
                $data->description = $request->description;
                $data->save();

                if ($request->creating) {
                    return redirect()->back()
                        ->with('success', 'Thêm sản phẩm mới thành công!');
                }
                return redirect()->route('product.list')
                    ->with('success', 'Thêm sản phẩm mới thành công!');

            } catch
            (\Throwable $e) {
                return redirect()
                    ->back()
                    ->withErrors(['error' => 'Có lỗi trong quá trình xử lý, vui lòng thử lại!']);
            }
        }
        $category = tbl_Category::all();
        return view('addon.product.create', compact('category'));
    }

    public function delete($id)
    {
        $data = tbl_Product::find($id);

        if (!$data)
            return response()->json(['message' => 'Sản phẩm không tồn tại.'], 404);

        $data->delete();
        return response()->json(['message' => 'Sản phẩm đã được xóa thành công.']);

    }
}
