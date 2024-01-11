<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PharIo\Manifest\Author;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Authors::orderBy('name', 'asc')->get();

        return view('pages.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.authors.create');
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
                'name.required' => 'Name must be filled.',
            ];
            
            $request->validate([
                'name' => 'required',
            ], $customMessage);

            DB::beginTransaction(); 
            $data = $request->collect();

            $newAuthor = new Authors();
            $newAuthor->name = $data['name'];
            $newAuthor->about = $data['about'];
            if($newAuthor->save()){
                DB::commit();
            }
            return redirect()->route('authors.index')->with('status','Author created!');
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
        $author = Authors::findOrFail($id);

        return view('pages.authors.edit', [
            'author' => $author
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
                'name.required' => 'Name must be filled.',
            ];
            
            $request->validate([
                'name' => 'required',
            ], $customMessage);

            DB::beginTransaction(); 
            $data = $request->collect();

            $author = Authors::findOrFail($id);
            $author->name = $data['name'];
            $author->about = $data['about'];
            if($author->save()){
                DB::commit();
            }
            
            return redirect()->route('authors.index')->with(["status" => "Success", "msg" => "Author updated!"]);

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
            $author = Authors::findOrFail($id);
            $author->delete();
            
            return redirect()->route('authors.index')->with(["status" => "Success", "msg" => "Author deleted!"]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
