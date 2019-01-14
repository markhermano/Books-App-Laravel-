<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = auth()->user()->role;
        $userID = auth()->user()->id;

        if($role == "admin"){
            $books = Book::all();
            return view('dashboard')->with('books', $books)->with('heading', 'All Books');
        }
        elseif($role == "writer"){
            $user = User::find(auth()->user()->id);
            return view('dashboard')->with('books', $user->books)->with('heading', 'Your Books');
        }
        elseif($role == "reader"){
            $books = Book::all();
            $available_books = array();
            foreach($books as $book){
                $readers = $book->readers()->get();
                if(count($readers) > 0){

                    if(in_array($userID, array_column($readers->toArray(), 'id'))){
                        // echo $book->title."<br>";
                        $available_books[] = $book;
                    }
                }
            }
            return view('dashboard')->with('books', $available_books)->with('heading', 'Avalilable Books');
        }
    }
}
