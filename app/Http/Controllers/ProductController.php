<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function table(Request $request)
     {
         $loan = Product::query();
 
         // Process sorting request from DataTables mantap
         $order_column = $request->input('order.0.columns');
         $order_direction = $request->input('order.0.dir');
         if (!empty($order_column) && !empty($order_direction)) {
             $loan->orderBy($order_column, $order_direction);
         }
 
 
         return DataTables::of($loan)
             ->addIndexColumn()
             ->make(true);
     }

    public function index()
    {

        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->route('products.index')->with('success', 'Data  Produk berhasil DiHapus');
    }
}
