<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Note::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('books.index'));
    }

    public function delete($id)
    {
        Note::findorfail($id)->delete();
        return redirect(route('books.index'));
    }
}
