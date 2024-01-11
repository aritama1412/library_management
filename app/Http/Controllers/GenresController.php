<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genres::orderBy('genre', 'asc')->get();

        return view('pages.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.genres.create');
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
                'genre.required' => 'Genre must be filled.',
            ];
            
            $request->validate([
                'genre' => 'required',
            ], $customMessage);

            DB::beginTransaction(); 
            $data = $request->collect();

            $genre = new Genres();
            $genre->genre = $data['genre'];
            if($genre->save()){
                DB::commit();
            }
            return redirect()->route('genres.index')->with('status','Genre created!');
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
        $genre = Genres::findOrFail($id);

        return view('pages.genres.edit', [
            'genre' => $genre
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
                'genre.required' => 'Genre must be filled.',
            ];
            
            $request->validate([
                'genre' => 'required',
            ], $customMessage);

            DB::beginTransaction(); 
            $data = $request->collect();

            $genre = Genres::findOrFail($id);
            $genre->genre = $data['genre'];
            if($genre->save()){
                DB::commit();
            }
            
            return redirect()->route('genres.index')->with(["status" => "Success", "msg" => "Genre updated!"]);

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
            $genre = Genres::findOrFail($id);
            $genre->delete();
            
            return redirect()->route('genres.index')->with(["status" => "Success", "msg" => "Genre deleted!"]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
