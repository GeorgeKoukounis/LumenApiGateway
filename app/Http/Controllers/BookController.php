<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\BookService;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    public $bookService;
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * return the list of book.
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->succcessResponse($this->bookService->obtainBooks());
    }

    /**
     * Create one new book.
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorService->obtainAuthor($request->author_id);
        return $this->succcessResponse($this->bookService->createBooks($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obatins and show one book.
     *
     * @return Illuminate\Http\Response
     */
    public function show($book)
    {
        return $this->succcessResponse($this->bookService->obtainBook($book));
    }

    /**
     * Update an existing book.
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book)
    {
        return $this->succcessResponse($this->bookService->editBook($request->all(), $book));
    }

    /**
     * Remove an existing book.
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($book)
    {
        return $this->succcessResponse($this->bookService->deleteBook($book));
    }
}
