<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    public function index()
    {
        $categoryProducts = CategoryProduct::all();
        return response()->json([
            'success' => true,
            'message' => 'Semua Produk kategori berhasil diambil',
            'data'    => $categoryProducts
        ]);
    }


    public function store(Request $request)
    {
        $categoryProduct = CategoryProduct::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Produk kategori berhasil dibuat',
            'data'    => $categoryProduct
        ], 201);
    }


    public function show($id)
    {
        $categoryProduct = CategoryProduct::find($id);
        if ($categoryProduct) {
            return response()->json([
                'success' => true,
                'message' => 'Detail produk kategori',
                'data'    => $categoryProduct
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Produk kategori tidak ditemukan'
        ], 404);
    }


    public function update(Request $request, $id)
    {
        $categoryProduct = CategoryProduct::find($id);
        if ($categoryProduct) {
            $categoryProduct->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Produk kategori berhasil diUpdate',
                'data'    => $categoryProduct
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Produk kategori tidak ditemukan'
        ], 404);
    }


    public function destroy($id)
    {
        $categoryProduct = CategoryProduct::find($id);
        if ($categoryProduct) {
            $categoryProduct->delete();
            return response()->json([
                'success' => true,
                'message' => 'Produk kategori berhasil dihapus'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Produk kategori tidak ditemukan'
        ], 404);
    }

}
