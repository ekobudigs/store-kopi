<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use Yajra\DataTables\Facades\DataTables;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function table(Request $request)
     {
         $loan = CategoryProduct::query();
 
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
     

        return view('categoryproduct.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoryproduct.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'desc' => 'nullable|string',
        ]);
    
        $categoryProduct = CategoryProduct::create($validatedData);
    
        return redirect()->route('categoryproducts.index')->with('success', 'Kategori Produk "'.$categoryProduct->nama.'" berhasil Dibuat');
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
        CategoryProduct::destroy($id);
        return redirect()->route('categoryproducts.index')->with('success', 'Data Kategori Produk berhasil DiHapus');
    }
}
