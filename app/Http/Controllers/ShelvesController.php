<?php

namespace App\Http\Controllers;

use App\Models\Shelves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ShelvesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shelves = Shelves::orderBy('name', 'asc')->get();

        return view('pages.shelves.index', compact('shelves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.shelves.create');

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

            $shelf = new Shelves();
            $shelf->name = $data['name'];
            if($shelf->save()){
                DB::commit();
            }
            
            return redirect()->route('shelves.index')->with(["status" => "Success", "msg" => "Shelf created!"]);

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
        $shelves = Shelves::findOrFail($id);

        return view('pages.shelves.edit', [
            'shelves'=> $shelves
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

            $shelves = Shelves::findOrFail($id);
            $shelves->name = $data['name'];
            if($shelves->save()){
                DB::commit();
            }
            
            return redirect()->route('shelves.index')->with(["status" => "Success", "msg" => "Shelf updated!"]);

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
            $shelves = Shelves::findOrFail($id);
            $shelves->delete();
            
            return redirect()->route('shelves.index')->with(["status" => "Success", "msg" => "Shelf deleted!"]);

        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
