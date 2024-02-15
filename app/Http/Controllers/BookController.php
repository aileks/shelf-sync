<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BookController extends Controller
{
  /**
   * Renders the main book page that shows all books in the collection.
   * Gathers all books from the database and paginates them, then sends them to the Inertia page.
   * @param Request $request The GET request for the page.
   * @return Response The Inertia response to render the page.
   */
  public function index(Request $request): Response
  {
    if (!auth()->user()->books()->exists()) {
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
      ->when($search, fn($query, $search) => $query->where(function ($query) use ($search) {
        $query->where('title', 'like', "%{$search}%")
          ->orWhere('author', 'like', "%{$search}%");
      }))
      ->orderBy($sortBy, $sortDirection)
      ->paginate(20)
      ->through(fn($book) => [
        'id' => $book->id,
        'title' => $book->title,
        'author' => $book->author,
        'pages' => $book->pages,
        'genre' => $book->genre,
        'publish_year' => $book->publish_year,
        'read' => $book->read,
        'date_read' => $book->date_read,
        'created_at' => $book->updated_at,
      ])
      ->withQuerystring();

    return Inertia::render('Books/Index', [
      'books' => $books,
      'success' => $request->session()->get('success'),
    ]);
  }

  /**
   * Checks of a book already exists in the collection, and if not, adds it to the database.
   * @param Request $request The POST request for the new book.
   * @return RedirectResponse The response to redirect to the main books page.
   */
  public function store(Request $request): RedirectResponse
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
      'publish_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
      'read' => ['boolean'],
      'date_read' => ['nullable', 'date'],
    ]);

    $request->user()->books()->create($data);

    $request->session()->flash('success', 'Book added! Your collection grows...');

    return to_route('books');
  }

  /**
   * Renders the page to add a new book to the database.
   * @return Response The Inertia response to render the "add book" page.
   */
  public function create()
  {
    return Inertia::render('Books/Add');
  }

  /**
   * Renders the page to edit an existing book to the database.
   * @param Book $book The book object data to edit that is passed to the form.
   * @return Response The Inertia response to render the "edit book" page.
   */
  public function edit(Book $book): Response
  {
    return Inertia::render('Books/Edit', [
      'book' => $book,
    ]);
  }

  /**
   * Updates a book in the database with the new input and notifies
   * the user of a successful update with a flash message.
   * @param Request $request The PATCH request for the book update.
   * @param Book $book The book object to update.
   * @return RedirectResponse The response to redirect to the main books page.
   */
  public function update(Request $request, Book $book)
  {
    $data = $request->validate([
      'title' => ['string', 'max:255', 'min:3'],
      'author' => ['string', 'max:255', 'min:3'],
      'pages' => ['nullable', 'integer'],
      'genre' => ['required', 'string'],
      'publish_year' => ['required', 'integer', 'min:1800', 'max:' . date('Y')],
      'read' => ['boolean'],
      'date_read' => ['nullable', 'date'],
    ]);

    $book->update($data);

    $request->session()->flash('success', 'Book successfully updated.');

    return to_route('books');
  }

  /**
   * Deletes a book from the database and then re-renders
   * the main books page with the updated book data and notifies
   * the user of a successful deletion with a flash message.
   * @param Book $book The book object to delete.
   * @return Response The Inertia response to re-render the main books page.
   */
  public function destroy(Book $book)
  {
    $book->delete();
    $books = auth()->user()->books()->get();

    return Inertia::render('Books/Index', [
      'books' => $books,
      'success' => session()->flash('success', 'Book successfully deleted.'),
    ]);
  }
}
