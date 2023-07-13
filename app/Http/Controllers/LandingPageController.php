<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->filter(request(['search']))->paginate(15)->withQueryString();
        return view('landing-page.index', compact('products'));
    }
}
