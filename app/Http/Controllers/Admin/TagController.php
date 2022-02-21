<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $tags = Tag::all();

    return view("admin.tags.index", compact("tags"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view("admin.tags.create");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // validazione
    $request->validate($this->validationRules);

    $data = $request->all();

    // aggiorno la risorsa con i nuovi dati
    $newCat = new Tag();
    $newCat->name = $data["name"];

    //gestisco lo slug
    $slug = Str::slug($newCat->name, '-');
    $i = 1;

    while (Category::where("slug", $slug)->first()) {
      $slug = Str::slug($newCat->name, '-') . "-{$i}";
      $i++;
    }

    $newCat->slug = $slug;

    $newCat->save();
    // restituisco la pagina show della risorsa modificata
    return redirect()->route('categories.show', $newCat->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function show(Tag $tag)
  {
    return view("admin.tags.show", compact("tag"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function edit(Tag $tag)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Tag $tag)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tag $tag)
  {
    //
  }
}
