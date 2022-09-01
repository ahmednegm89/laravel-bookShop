<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class ApiBookController extends Controller
{
    public function index()
    {
        $books = Book::get();
        return response()->json($books);
    }
    public function show($id)
    {
        $book = Book::with('Categories')->findorfail($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100|unique:books',
            'desc' => 'required|string',
            'img' => 'required|image|mimes:jpeg,jpg,png|max:3072',
            'category_ids' => 'required',
            'category_ids.*' => 'required|exists:categories,id',
        ]);

        //img
        $img = $request->file('img');
        $ext = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . "_" . rand() . ".$ext";
        $img->move(public_path('uploads/books'), $name);

        $book = Book::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $name
        ]);

        $book->categories()->sync($request->category_ids);

        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'desc' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,jpg,png|max:3072'
        ]);
        $book = Book::findOrFail($id);
        $name = $book->img;
        // img 
        if ($request->hasFile('img')) {
            if ($name !== null) {
                unlink(public_path('uploads/books/') . $name);
            }
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = "book-" . uniqid() . "_" . rand() . ".$ext";
            $img->move(public_path('uploads/books'), $name);
        }
        $book->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $name
        ]);
    }

    public function delete($id)
    {
        $book = Book::findorfail($id);
        if ($book->img !== null) {
            unlink(public_path('uploads/books/') . $book->img);
        }
        $book->delete();
        $msg = 'book deleted succ';
        return response()->json($msg);
    }
}
