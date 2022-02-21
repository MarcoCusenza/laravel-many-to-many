<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

class CategoryController extends Controller
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
    $categories = Category::all();

    return view("admin.categories.index", compact("categories"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view("admin.categories.create");
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
    // $posts = Post::all();

    // var_dump($data["name"]);

    // foreach ($posts as $post) {
    //   var_dump($post["name"]);
    //   if ($post["name"] == $data["name"]) {
    //     dd("ERRORE: La categoria esiste già");
    //   }
    // }

    // aggiorno la risorsa con i nuovi dati
    $newCat = new Category();
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
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Category $category)
  {
    return view("admin.categories.show", compact("category"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Category $category)
  {
    return view("admin.categories.edit", compact("category"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Category $category)
  {
    // validazione
    $request->validate($this->validationRules);

    $data = $request->all();
    // $posts = Post::all();

    // var_dump($data["name"]);

    // foreach ($posts as $post) {
    //   var_dump($post["name"]);
    //   if ($post["name"] == $data["name"]) {
    //     dd("ERRORE: La categoria esiste già");
    //   }
    // }

    //gestisco lo slug
    if ($category->name != $data['name']) {
      $category->name = $data['name'];

      $slug = Str::slug($category->name, '-');

      if ($slug != $category->slug) {
        $i = 1;

        while (Post::where("slug", $slug)->first()) {
          $slug = Str::slug($category->name, '-') . "-{$i}";
          $i++;
        }

        $category->slug = $slug;
      }
    }

    $category->save();

    return redirect()->route('categories.show', $category->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    $category->delete();

    return redirect()->route("categories.index");
  }
}
