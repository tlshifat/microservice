<?php

namespace App\Traits;


use Illuminate\Http\Response;

trait ApiResponse {

    public function successResponse ($data,$code=Response::HTTP_OK){
        return \response($data,$code)->header('Content-Type','application/json');
    }

    public function errorResponse($message,$code=Response::HTTP_NOT_ACCEPTABLE){
        return \response()->json(['message'=>$message,'code'=>$code]);
    }

    public function errorMessage ($message,$code=Response::HTTP_OK){
        return \response($message,$code)->header('Content-Type','application/json');
    }

    public function validResponse($data,$code=Response::HTTP_OK){
        return \response()->json(['data'=>$data],$code);
    }
}
