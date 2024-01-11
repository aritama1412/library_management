<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\BooksGenres;
use App\Models\Genres;
use App\Models\Shelves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $books = Books::orderBy('title', 'asc')->get();

        return view('pages.books.index', [
            'books'=> $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Authors::orderBy('name', 'asc')->get();
        $shelves = Shelves::orderBy('name', 'asc')->get();
        $genres = Genres::orderBy('genre', 'asc')->get();

        return view('pages.books.create', [
            'authors' => $authors,
            'shelves' => $shelves,
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $customMessage = [
                'author_id.required' => 'Author must be filled.',
                'title.required' => 'Title must be filled.',
                'description.required' => 'Description must be filled.',
                'shelves_id.required' => 'Shelf must be filled.',
                'release_date.required' => 'Release date must be filled.',
            ];
            
            $request->validate([
                'author_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'shelves_id' => 'required',
                'release_date' => 'required',
            ], $customMessage);

            DB::beginTransaction(); 
            $data = $request->collect();

            $book = new Books();
            $book->author_id = $data['author_id'];
            $book->title = $data['title'];
            $book->note = $data['note'];
            $book->description = $data['description'];
            $book->shelves_id = $data['shelves_id'];
            $book->release_date = date("Y-m-d", strtotime($data['release_date']));
            if($book->save()){
                if(isset($data['data'])){
                    foreach ($data['data'] as $key => $value) {
                        $books_genre = new BooksGenres();
                        $books_genre->books_id = $book->id;
                        $books_genre->genres_id = $value['genres_id'];
                        $books_genre->save();
                    }
                }
                DB::commit();
            }
            
            return redirect()->route('books.index')->with(["status" => "Success", "msg" => "Book created!"]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
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
        $books = Books::findOrFail($id);
        $authors = Authors::orderBy('name', 'asc')->get();
        $shelves = Shelves::orderBy('name', 'asc')->get();
        $genres = Genres::orderBy('genre', 'asc')->get();
        $books_genres = BooksGenres::orderBy('id', 'asc')->get();

        return view('pages.books.edit', [
            'books' => $books,
            'authors' => $authors,
            'shelves' => $shelves,
            'genres' => $genres,
            'books_genres' => $books_genres,
        ]);
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
        try {
            $customMessage = [
                'author_id.required' => 'Author must be filled.',
                'title.required' => 'Title must be filled.',
                'description.required' => 'Description must be filled.',
                'shelves_id.required' => 'Shelf must be filled.',
                'release_date.required' => 'Release date must be filled.',
            ];
            
            $request->validate([
                'author_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'shelves_id' => 'required',
                'release_date' => 'required',
            ], $customMessage);

            DB::beginTransaction(); 
            $data = $request->collect();

            $book = Books::findOrFail($id);
            $book->author_id = $data['author_id'];
            $book->title = $data['title'];
            $book->note = $data['note'];
            $book->description = $data['description'];
            $book->shelves_id = $data['shelves_id'];
            $book->release_date = date("Y-m-d", strtotime($data['release_date']));
            if($book->save()){
                BooksGenres::where('books_id', $id)->delete(); // remove all existing genre

                if(isset($data['data'])){
                    foreach ($data['data'] as $key => $value) {
                        $books_genre = new BooksGenres();
                        $books_genre->books_id = $book->id;
                        $books_genre->genres_id = $value['genres_id'];
                        $books_genre->save();
                    }
                }
                DB::commit();
            }
            
            return redirect()->route('books.index')->with(["status" => "Success", "msg" => "Book updated!"]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $book = Books::findOrFail($id);
            $book->delete();
            BooksGenres::where('books_id', $id)->delete(); // remove all existing genre
            
            return redirect()->route('books.index')->with(["status" => "Success", "msg" => "Book deleted!"]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
