<?php

namespace App\Http\Controllers;

use App\Models\tbl_Category;
use App\Models\tbl_Product;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

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

                $code = $request->code != null ? $request->code : $this->genCode();
                $price = str_replace(',', '', $request->price);
                $data = new tbl_Product();
                $data->code = $code;
                $data->price = $price;
                $data->name = $request->name;
                $data->unit = $request->unit;
                $data->category_id = $request->category;
                $data->description = $request->description;
                $data->save();

                if($request->creating){
                    return redirect()->back()
                        ->with('success', 'Thêm sản phẩm mới thành công!');
                }
                return redirect()->route('product.list')
                    ->with('success', 'Thêm sản phẩm mới thành công!');

            } catch (\Throwable $e) {
                return redirect()
                    ->back()
                    ->withErrors('error', 'Có lỗi trong quá trình xử lý, vui lòng thử lại!');
            }
        }
        $category = tbl_Category::all();
        return view('addon.product.create', compact('category'));
    }

    public function edit(Request $request, $id)
    {

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
