<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class ProductController extends Controller
{
    public function list()
    {
        try {
            $products = Product::all();
            return view('product.list', compact('products'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function form()
    {
        $productTypes = ProductType::orderBy('name','asc')->get();
        return view('product.form',compact('productTypes'));
    }

    public function save(Request $request)
    {
        try {
            Product::create($request->all());
            return redirect('/product/list');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::find($id);

            return view('product.form', compact('product'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->update($request->all());

            return redirect('/product/list');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function remove($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            return redirect('/product/list');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (strlen($keyword) > 0) {
            $products = Product::where('name', 'like', '%' . $keyword . '%')->get();
        } else {
            $products = Product::all();
        }
        return view('product.list', compact('products', 'keyword'));
    }

    //คัดกรองข้อมูล
    public function sort()
    {
        $sort = "desc";
        $products = Product::orderBy('price', $sort)->get();

        return view('product.list', compact('products', 'sort'));
    }
    public function priceMoreThan()
    {
        $price = 10;
        $products = Product::where('price', '>', $price)->get();

        return view('product.list', compact('products', 'price'));
    }
    public function priceLessThan()
    {
        $price = 10;
        $products = Product::where('price', '<', $price)->get();

        return view('product.list', compact('products', 'price'));
    }
    public function priceBetween()
    {
        $priceFrom = 10;
        $priceTo = 100;
        $products = Product::whereBetween('price', [$priceFrom, $priceTo])->get();

        return view('product.list', compact('products', 'priceFrom', 'priceTo'));
    }

    public function priceNotBetween()
    {
        $priceFrom = 10;
        $priceTo = 100;
        $products = Product::whereNotBetween('price', [$priceFrom, $priceTo])->get();

        return view('product.list', compact('products', 'priceFrom', 'priceTo'));
    }
    public function priceIn() {
        $prices = [10, 5, 30];
        $products = Product::whereIn('price', $prices)->get();

        return view('product.list', compact('products', 'prices'));
    }
    public function priceMaxMinCountAvg() {
        $priceMax = Product::max('price');
        $priceMin = Product::min('price');
        $priceCount = Product::count();
        $priceAvg = Product::avg('price');

        return view('product.max-min-count-avg', compact('priceMax', 'priceMin', 'priceCount', 'priceAvg')); 
    }
}