<?php

namespace App\Http\Controllers;

use App\Author;
use App\Services\AuthorServices;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use ApiResponse;
    public $authorServices;
    public function __construct(AuthorServices $authorServices)
    {
        $this->authorServices= $authorServices;
    }

    public function index(){

        return $this->successResponse($this->authorServices->obtainAuthors());
    }


    public function store(Request $request){
        return $this->successResponse($this->authorServices->createAuthor($request->all(),Response::HTTP_CREATED));
    }


    public function show($id){
        return $this->successResponse($this->authorServices->obtainAuthor($id));
    }


    public function update(Request $request,$id){
        return $this->successResponse($this->authorServices->editAuthor($request->all(),$id));
    }


    public function destroy($id){
        return $this->successResponse($this->authorServices->deleteAuthor($id));
    }

    //
}
