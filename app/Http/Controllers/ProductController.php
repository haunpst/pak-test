<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        return view('addon.product.index');
    }

    public function store(Request $request)
    {

    }

    public function edit(Request $request, $id)
    {

    }

    public function delete($id)
    {

    }
}
