<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'active');

        if ($filter == 'deleted') {
            $products = Product::onlyTrashed()->get();
        } elseif ($filter == 'all') {
            $products = Product::withTrashed()->get();
        } else {
            $products = Product::all();
        }

        return view('admin.products.index', compact('products', 'filter'));
    }

    public function show($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
{
    \Log::info('Store method called');
    \Log::info($request->all());

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'brand_id' => 'required|exists:brands,id',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    \Log::info('Validation passed');

    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->brand_id = $request->brand_id;
    $product->category_id = $request->category_id;

    if ($request->hasFile('image')) {
        \Log::info('Image upload initiated');
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('storage/products'), $imageName);
        $product->image = $imageName;
        \Log::info('Image uploaded: ' . $imageName);
    }

    $product->save();

    \Log::info('Product saved: ', ['id' => $product->id]);

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('admin.products.index')->with('success', 'Product restored successfully.');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted permanently.');
    }
}
