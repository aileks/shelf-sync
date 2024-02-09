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
    public function index(Request $request): Response
    {
        if (!auth()->user()->books()->exists()) {
            return Inertia::render('Books/Index', ['books' => []]);
        }

        $search = $request->input('search');

        $books = auth()->user()->books()
            ->when($search, fn($query, $search) => $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            }))
            ->paginate(25)
            ->withQuerystring()
            ->through(fn($book) => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'pages' => $book->pages,
                'genre' => $book->genre,
                'publishYear' => $book->publishYear,
                'read' => $book->read,
            ])->orderBy('created_at');

        return Inertia::render('Books/Index', [
            'books' => $books,
            'success' => $request->session()->get('success'),
        ]);
    }

    public function store(Request $request)
    {
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

        $request->session()->flash('success', 'Book added! Your collection grows...');

        return to_route('books');
    }

    public function create()
    {
        return Inertia::render('Books/Add');
    }

    public function edit(Book $book): Response
    {
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

        $request->session()->flash('success', 'Book successfully updated.');

        return to_route('books');
    }

    public function destroy(Request $request, Book $book)
    {
        $book->delete();

        $request->session()->flash('success', 'Book successfully deleted.');
    }
}
