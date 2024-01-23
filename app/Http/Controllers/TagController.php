<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|max:40',
            'description' => 'required|max:100',
        ]);
        $tag = new Tag();
        $tag->tag = $request->tag;
        $tag->description = $request->description;
        $tag->isPublic = true;
        $tag->user_id = $request->id_user;
        $tag->save();
        return redirect()->route('tags.index')->with('message', 'Etiqueta registrada existosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tag' => 'required|max:40',
            'description' => 'required|max:100',
        ]);
        Tag::where('id', $id)->update([
            'tag' => $request->tag,
            'description' => $request->description,
        ]);
        return redirect()->route('tags.index')->with('message', 'Etiqueta actualizada existosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->route('tags.index')->with('message', 'Etiqueta borrada existosamente');
    }
}
