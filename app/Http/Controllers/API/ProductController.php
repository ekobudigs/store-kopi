<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $Products = Product::with('categoryProduct')->get();
        return response()->json([
            'success' => true,
            'message' => 'Semua Produk  berhasil diambil',
            'data'    => $Products
        ]);
    }


    public function store(Request $request)
    {
        $Products = Product::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Produk  berhasil dibuat',
            'data'    => $Products
        ], 201);
    }


    public function show($id)
    {
        $Product = Product::with('categoryProduct')->find($id);
        if ($Product) {
            return response()->json([
                'success' => true,
                'message' => 'Detail produk ',
                'data'    => $Product
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Produk  tidak ditemukan'
        ], 404);
    }


    public function update(Request $request, $id)
    {
        $Product = Product::find($id);
        if ($Product) {
            $Product->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Produk  berhasil diUpdate',
                'data'    => $Product
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Produk  tidak ditemukan'
        ], 404);
    }


    public function destroy($id)
    {
        $Product = Product::find($id);
        if ($Product) {
            $Product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Produk  berhasil dihapus'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Produk  tidak ditemukan'
        ], 404);
    }

}
