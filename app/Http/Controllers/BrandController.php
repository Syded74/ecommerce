<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'active');
    
        if ($filter == 'deleted') {
            $brands = Brand::onlyTrashed()->get();
        } elseif ($filter == 'all') {
            $brands = Brand::withTrashed()->get();
        } elseif ($filter == 'inactive') {
            $brands = Brand::where('status', 'inactive')->get();
        } else {
            $brands = Brand::where('status', 'active')->get();
        }
    
        return view('admin.brands.index', compact('brands', 'filter'));
    }

    public function show($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        return view('admin.brands.show', compact('brand'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->status = $request->input('status');
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand status updated successfully.');
    }

    public function restore($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        $brand->restore();

        return redirect()->route('admin.brands.index')->with('success', 'Brand restored successfully.');
    }

    public function forceDelete($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        $brand->forceDelete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand permanently deleted successfully.');
    }
}
