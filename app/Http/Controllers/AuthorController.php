<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the authors microservices.
     *
     * @var AuthorService
     */
    public $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * return the list of authors.
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->succcessResponse($this->authorService->obtainAuthors());
    }

    /**
     * Create one new author.
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->succcessResponse($this->authorService->createAuthors($request->all(), Response::HTTP_CREATED));
    }

    /**
     * Obatins and show one Author.
     *
     * @return Illuminate\Http\Response
     */
    public function show($author)
    {
        return $this->succcessResponse($this->authorService->obtainAuthor($author));
    }

    /**
     * Update an existing author.
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {
        return $this->succcessResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * Remove an existing author.
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($author)
    {
        return $this->succcessResponse($this->authorService->deleteAuthor($author));
    }
}
