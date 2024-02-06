<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Validator;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        if (!auth()->check()) {
            return Inertia::render('Login');
        }

        if (!auth()->user()->books()->exists()) {
            return Inertia::render('Books/Index', ['books' => []]);
        }

        $search = $request->query('search');

        if ($search) {
            $books = auth()->user()->books()
                ->select('id', 'title', 'author', 'genre', 'read', 'pages')
                ->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'asc')
                ->paginate(20);
        } else {
            $books = auth()->user()->books()
                ->select('id', 'title', 'author', 'genre', 'read', 'pages')
                ->orderBy('created_at', 'asc')
                ->paginate(20);
        }

        return Inertia::render('Books/Index', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        if (!auth()->check()) {
            return Inertia::render('Login');
        }

        return Inertia::render('Books/Add');
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return Inertia::location(route('/login'));
        }

        $user = auth()->id();

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'author' => ['required', 'string', 'max:255', 'min:3'],
            'pages' => ['nullable', 'integer'],
            'genre' => ['required', 'string'],
            'publishYear' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'read' => ['boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $validated['user_id'] = $user;

        $request->user()->books()->create($validated);

        return Inertia::location(route('books'));
    }

    public function edit(Book $book): Response
    {
        if (!auth()->check()) {
            return Inertia::render('Login');
        }

        return Inertia::render('Books/Edit', [
            'book' => $book,
        ]);
    }

    public function update(Request $request)
    {
        $bookData = $request->input('data');

        $validator = Validator::make($bookData, [
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'author' => ['required', 'string', 'max:255', 'min:3'],
            'pages' => ['nullable', 'integer'],
            'genre' => ['required', 'string'],
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

        return Inertia::location(route('books'));
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return Inertia::location(route('books'));
    }
}
