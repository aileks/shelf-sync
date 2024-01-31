<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Validator;

class BookController extends Controller
{
    public function index(): Response|RedirectResponse
    {
        if (empty(auth()->user()->books)) {
            return Inertia::render('Books/Index', ['books' => []]);
        }

        return Inertia::render('Books/Index', [
            'books' => auth()->user()->books,
        ]);
    }

    public function add(): Response
    {
        return Inertia::render('Books/Add');
    }

    public function store(Request $request): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $fields = $request->validate([
            'user_id' => ['exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'pages' => ['required', 'integer'],
            'genre' => ['required', 'string', 'max:255'],
            'publishYear' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'read' => ['boolean'],
        ]);

        $request->user()->books()->create($fields);

        return redirect(('/books'));
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $bookData = $request->input('data');

        $validator = Validator::make($bookData, [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'pages' => ['required', 'integer'],
            'genre' => ['required', 'string', 'max:255'],
            'publishYear' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'read' => ['boolean'],
        ]);

        if ($validator->fails()) {
            return redirect('/books/edit/' . $bookData['id'])
                ->withErrors($validator)
                ->withInput();
        }

        $book = Book::find($bookData['id']);
        $book->update($validator->validated());

        return redirect('/books');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }
}
