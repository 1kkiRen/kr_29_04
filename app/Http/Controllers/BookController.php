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
        $book->availability = $req->availability;
        $book->save();
        
        return redirect('/');     
    }

    public function delete($id){
        $book = Libra::find($id);
        $book->delete();

    }

    public function changeAvailabilty($id){
        $book = Libra::find($id);
        if($book->availability == 'Доступна') {
            $book->availability = 'Не доступна';
            $book->save();
            return redirect('/');  
        }
        if($book->availability == 'Не доступна') {
            $book->availability = 'Доступна';
            $book->save();
            return redirect('/');  
        }

        // return $book->availability;
        
    }
    
}
