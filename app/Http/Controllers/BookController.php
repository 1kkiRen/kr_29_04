<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libra;

class BookController extends Controller
{
    public function all(){
        $books = Libra::All();

        return $books;
    }

    public function add(Request $req){
        $book = new Libra;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->availabilty = $req->availabilty;
        $book->save();
        
        return "ok" ;       
    }

    public function delete($id){
        $book = Libra::destroy($id);

        return "ok";
    }

    public function change_availabilty($id){
        $book = Libra::find($id);
        $book->availabilty = !$book->availabilty;

        return "ok";
    }
    
}
