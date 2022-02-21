<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
  protected $validationRules = [
    "name" => "required|string|max:50",
  ];

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
    $newTag = new Tag();
    $newTag->name = $data["name"];

    //gestisco lo slug
    $slug = Str::slug($newTag->name, '-');
    $i = 1;

    while (Tag::where("slug", $slug)->first()) {
      $slug = Str::slug($newTag->name, '-') . "-{$i}";
      $i++;
    }

    $newTag->slug = $slug;

    $newTag->save();
    // restituisco la pagina show della risorsa modificata
    return redirect()->route('tags.show', $newTag->id);
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
    return view("admin.tags.edit", compact("tag"));
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
    // validazione
    $request->validate($this->validationRules);

    $data = $request->all();

    //gestisco lo slug
    if ($tag->name != $data['name']) {
      $tag->name = $data['name'];

      $slug = Str::slug($tag->name, '-');

      if ($slug != $tag->slug) {
        $i = 1;

        while (Tag::where("slug", $slug)->first()) {
          $slug = Str::slug($tag->name, '-') . "-{$i}";
          $i++;
        }

        $tag->slug = $slug;
      }
    }

    $tag->save();

    return redirect()->route('tags.show', $tag->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Tag  $tag
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tag $tag)
  {
    $tag->delete();

    return redirect()->route("tags.index");
  }
}
