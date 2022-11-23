<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('user.product', compact('products'))
                    ->with('i', (request()->input('page', 1) -1) *5);
    }

    public function show()
    {
        $products = Product::all();
        $customers = Customer::all();

        return view('user.issue', compact('products', 'customers'));
    }

    function storeProduct(Request $request){

        $size = $request->size;
        $price = $request->price;
        $barcode = Helper::BarcodeGenerator(new Product, 'barcode', 3, 4445645);

        $q = new Product;
        $q->barcode = $barcode;
        $q->size = $size;
        $q->price = $price;
        $q->save();

        return redirect()->route('user.product');

    }

    function edit($id){
        $product = Product::find($id);

        return view('user.editProduct', ['product' => $product]);
    }

    function update(Request $request){
        $product = Product::find($request->id);

        $product->size = $request->size;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('user.product');
    }

    function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('user.product');
    }
}
