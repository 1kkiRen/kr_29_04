<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libra;

class BookController extends Controller
{
    public function all(){
        $books = Libra::All();
        json_encode($books);
        return $books;
    }

    public function add(Request $req){
        $book = new Libra;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->availability = true;
        $book->save();
        
        return redirect('/');     
    }

    public function delete($id){
        $book = Libra::find($id);
        $book->delete();


        return "ok";
    }

    public function change_availabilty($id){
        $book = Libra::find($id);
        $book->availability = !$book->availability;

        return "ok";
    }
    
}
