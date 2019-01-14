<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Reader;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $books = Book::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        foreach($books as $book){
            $readers = $book->readers()->get();
            $data[] = array(
                'book' =>  $book,
                'readers' => $readers
            );
        }
        return view('booksAdministration')->with('myBooks', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);

        $book = new Book;
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->user_id= auth()->user()->id;
        $book->save();

        $notification = array(
            'message' => 'Book successfully Added!',
            'type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->readers()->detach();
        $book->delete();
        return "Successfully Deleted";
    }

    public function addReaderIndex($bookId){
        $book = Book::findOrFail($bookId);
        $currentReaders = $book->readers()->get();
        $readersArray = array();
        $readers = User::where('role', 'reader')->get();
        foreach($readers as $reader){
            if(!in_array($reader->id,array_column($currentReaders->toArray(),'id'))){
                $readersArray[] = $reader;
            }
        }
        return view('editReader')->with('book', $book)->with('currentReaders', $currentReaders)->with('readersArray', $readersArray);
    }

    public function addReaders(Request $request){
        $selectedReaders = $request->input('readers');
        $book = Book::findOrFail($request->input('bookId'));
        $book->readers()->attach($selectedReaders);
        return redirect()->back();
    }

    public function removeReaders(Request $request){
        $selectedReaders = $request->input('readers');
        $book = Book::findOrFail($request->input('bookId'));
        $book->readers()->detach($selectedReaders);
        return redirect()->back();
    }
}
