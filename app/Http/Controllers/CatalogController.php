<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Movie;
class CatalogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // also the function get
        // for pagination= Movie::paginate(3)
        $movies = Movie::all();
        return view('catalog.index', ["movies"=> $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            "year" => ['required', "numeric", "digits:4"],
            "director" => 'required',
            "poster" => 'required',
            "synopsis" => 'required',
        ]);
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->rented = false;
        $movie->save();
        session()->flash("success", "Movie added correctly");
        return redirect()->route('catalog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //otra forma usando DB::table("book")->get() de facades
        $movie = Movie::findOrFail($id);
        return view('catalog.show', ["movie" => $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $movie= Movie::find($id);
        return view('catalog.edit', ["movie" => $movie]);
        // if i want to pass more parametres
        // return view('catalog.edit', ["movie" => $movie, "id" => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            "year" => ['required', 'numeric', "digits:4"],
            "director" => 'required',
            "poster" => 'required',
            "synopsis" => 'required',
        ]);

        $movie = Movie::find($id);
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->poster = $request->input('poster');
        $movie->synopsis = $request->input('synopsis');
        $movie->save();
        session()->flash("success", "Movie updated correctly");
        return redirect()->route("catalog.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        session()->flash("success", "Movie deleted correctly");
        return redirect()->route('catalog.index');
    }
    public function rent(string $id){
        $movie = Movie::find($id);
        $movie->rented = true;
        $movie->save();
        session()->flash("success", "Movie rented correctly");
        return redirect()->route('catalog.show', $id);
    }
    public function return(string $id){
        $movie = Movie::find($id);
        $movie->rented = false;
        $movie->save();
        session()->flash("success", "Movie returned correctly");
        return redirect()->route('catalog.show', $id);
    }
}
