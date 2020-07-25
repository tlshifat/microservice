<?php

namespace App\Http\Controllers;

use App\Author;
use App\Services\AuthorServices;
use App\Services\BookServices;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use ApiResponse;
    public $bookServices;
    public function __construct(BookServices $bookServices)
    {
        $this->bookServices= $bookServices;
    }

    public function index(){

    }


    public function store(Request $request){

    }


    public function show($id){

    }


    public function update(Request $request,$id){

    }


    public function destroy($id){

    }

    //
}
