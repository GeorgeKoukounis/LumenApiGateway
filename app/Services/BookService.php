<?php

namespace  App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the books service.
     *
     * @var string
     */
    public $baseUri;

      /**
     * The secret to consume the authors service.
     *
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Obtain the full list of authors from the authors service.
     */
    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }


    /**
     * Create one author using author service.
     *  @return string
     */
    public function createBooks($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Obtain one single author from the author service
     * @return string
     */
    public function obtainBook($book)
    {
        return $this->performRequest('GET', "/books/{$book}");
    }

    /**
     * Update an instance of author using the author service
     * @return string
     */
    public function editBook($data, $book)
    {
        return $this->performRequest('PUT', "/books/{$book}", $data);
    }


    /**
     * Delete an instance of author using the author service
     * @return string
     */
    public function deleteBook($book)
    {
        return $this->performRequest('DELETE', "/books/{$book}");
    }
}
