<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category', ['categories' => $categories]);
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
            'image' => 'required|image|max:2048',
            'category' => 'required|max:40',
            'description' => 'required|min:20|max:400',
        ]);
        
        $imagenes = $request->file('image')->store('public/imagenes');
        $url = Storage::url($imagenes);

        $category = new Category();
        $category->category = $request->category;
        $category->description = $request->description;
        $category->image = $url;
        $category->isPublic = true;
        $category->user_id = $request->id_user;
        $category->save();
        return redirect()->route('categories.index')->with('message', 'Categoria registrada existosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if ($request->file() != null) {
            $request->validate([
                'changeImage' => 'required|image|max:2048',
                'category' => 'required|max:40',
                'description' => 'required|min:20|max:400',
            ]);
            $imagenes = $request->file('changeImage')->store('public/imagenes');
            $url = Storage::url($imagenes);
            
            Category::where('id', $id)->update([
                'category' => $request->category,
                'description' => $request->description,
                'image' => $url,
            ]);
        } else {
            $request->validate([
                'category' => 'required|max:40',
                'description' => 'required|min:20|max:400',
            ]);
            Category::where('id', $id)->update([
                'category' => $request->category,
                'description' => $request->description,
            ]);
        }
        return redirect()->route('categories.index')->with('message', 'Categoria actualizada existosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('message', 'Categoria borrada existosamente');
    }
}
