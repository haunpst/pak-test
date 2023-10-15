<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\tbl_Category;

class CategoryApiController extends Controller
{
    public function index()
    {
        $data = tbl_Category::paginate(10);
        return response()->json($data);
    }

}
