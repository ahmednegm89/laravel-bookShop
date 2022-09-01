<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use Illuminate\Contracts\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(3);
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $Category = Category::findOrFail($id);
        return view('categories.show', compact('Category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect(route('categories.index'));
    }

    public function edit($id)
    {
        $Category = Category::findorfail($id);
        return view('categories.edit', compact('Category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|string|max:100|unique:categories,name,$id"
        ]);
        Category::findOrFail($id)->update([
            'name' => $request->name
        ]);
        return redirect(route('categories.show', $id));
    }

    public function delete($id)
    {
        Category::findorfail($id)->delete();
        return redirect(route('categories.index'));
    }
}
