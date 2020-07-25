<?php

namespace App\Services;


use App\Traits\ConsumesExternalServices;

class BookServices
{
    use ConsumesExternalServices;
    public $baseUri;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

}
