<?php


namespace App\Services;


use App\Traits\ConsumesExternalServices;

class AuthorServices
{
        use ConsumesExternalServices;
        public $baseUri;
        public $secret;

        public function __construct()
        {
            $this->baseUri = config('services.authors.base_uri');
            $this->secret = config('services.authors.secret');

        }

        public function obtainAuthors(){
            return $this->performRequest('GET','/authors');
        }

        public function createAuthor($data){
            return $this->performRequest('POST','/authors',$data);
        }

        public function obtainAuthor($id){
            return $this->performRequest('POST',"/authors/{$id}");
        }

        public function editAuthor($data,$id){
            return $this->performRequest('PUT',"/authors/{$id}",$data);
        }

        public function deleteAuthor($id){
            return $this->performRequest('DELETE',"/authors/{$id}");
        }
}
