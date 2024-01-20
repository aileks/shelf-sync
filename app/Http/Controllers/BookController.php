<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BookController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Books/Index', [
            'books' => Book::with('user:id')->get(),
        ]);
    }

    public function add(): Response
    {
        return Inertia::render('Books/Add');
    }

    public function store(Request $request): RedirectResponse
    {
        $fields = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'pages' => ['required', 'integer'],
            'genre' => ['required', 'string', 'max:255'],
            'publishDate' => ['required', 'date'],
            'read' => ['required', 'boolean'],
        ]);

        Book::create($fields);

        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
