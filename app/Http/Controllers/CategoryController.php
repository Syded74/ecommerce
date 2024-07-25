<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'active');

        if ($filter == 'deleted') {
            $categories = Category::onlyTrashed()->get();
        } elseif ($filter == 'all') {
            $categories = Category::withTrashed()->get();
        } elseif ($filter == 'inactive') {
            $categories = Category::where('status', 'inactive')->get();
        } else {
            $categories = Category::where('status', 'active')->get();
        }

        return view('admin.categories.index', compact('categories', 'filter'));
    }

    public function updateStatus(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->status = $request->input('status');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category status updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index')->with('success', 'Category restored successfully.');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.index')->with('success', 'Category permanently deleted.');
    }
}
