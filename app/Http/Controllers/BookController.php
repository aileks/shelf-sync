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
        if (! auth()->user()->books()->exists()) {
            return Inertia::render('Books/Index', ['books' => []]);
        }

        $search = $request->input('search');
        $sortBy = $request->input('sort_by');
        $sortDirection = $request->input('sort_direction');

        if ($sortBy === null && $sortDirection === null) {
            $sortBy = 'created_at';
            $sortDirection = 'asc';
        }

        $books = auth()->user()->books()
            ->when($search, fn ($query, $search) => $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            }))
            ->orderBy($sortBy, $sortDirection)
            ->paginate(20)
            ->through(fn ($book) => [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'pages' => $book->pages,
                'genre' => $book->genre,
                'publishYear' => $book->publishYear,
                'read' => $book->read,
                'created_at' => $book->updated_at,
            ])
            ->withQuerystring();

        return Inertia::render('Books/Index', [
            'books' => $books,
            'success' => $request->session()->get('success'),
        ]);
    }

    public function store(Request $request)
    {
        // Check if book already exists
        $bookExists = auth()->user()->books()
            ->where('title', $request->input('title'))
            ->where('author', $request->input('author'))
            ->exists();
        if ($bookExists) {
            return back()->withErrors(['title' => 'Book already exists in your collection.']);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'author' => ['required', 'string', 'max:255', 'min:3'],
            'pages' => ['nullable', 'integer'],
            'genre' => ['required', 'string'],
            'publishYear' => ['required', 'integer', 'min:1800', 'max:'.date('Y')],
            'read' => ['boolean'],
        ]);

        $request->user()->books()->create($data);

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
            'publishYear' => ['required', 'integer', 'min:1800', 'max:'.date('Y')],
            'read' => ['boolean'],
        ]);

        $book = auth()->user()->books()->find($bookData['id']);
        if (! $book) {
            abort(403);
        }

        $book->update($validator->validated());

        $request->session()->flash('success', 'Book successfully updated.');

        return to_route('books');
    }

    public function destroy(Request $request, Book $book)
    {
        $book->delete();

        return to_route('books');
    }
}
