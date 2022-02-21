<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
  protected $validationRules = [
    "title" => "required|string|max:100",
    "content" => "required|string",
    "published" => "sometimes|accepted",
    "category_id" => "nullable|exists:categories,id",
    "image" => "nullable|image|mimes:jpeg,bmp,png|max:2048"
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::all();

    return view("admin.posts.index", compact("posts"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::all();

    return view("admin.posts.create", compact("categories"));
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

    // prendo i dati del form
    $data = $request->all();

    // aggiorno la risorsa con i nuovi dati
    $newPost = new Post();
    $newPost->title = $data["title"];
    $newPost->content = $data["content"];
    $newPost->published = isset($data["published"]);
    $newPost->category_id = $data["category_id"];

    //gestisco lo slug
    $slug = Str::slug($newPost->title, '-');
    $i = 1;

    while (Post::where("slug", $slug)->first()) {
      $slug = Str::slug($newPost->title, '-') . "-{$i}";
      $i++;
    }

    $newPost->slug = $slug;

    //se è presente l'immagine la salvo
    if (isset($data["image"])) {
      $path_image = Storage::put("uploads", $data["image"]);
      $newPost->image = $path_image;
    }

    $newPost->save();
    // restituisco la pagina show della risorsa modificata
    return redirect()->route('posts.show', $newPost->id);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    return view("admin.posts.show", compact("post"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    $categories = Category::all();

    return view("admin.posts.edit", compact("post", "categories"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {

    // validazione
    $request->validate($this->validationRules);

    $data = $request->all();

    //gestisco lo slug
    if ($post->title != $data['title']) {
      $post->title = $data['title'];

      $slug = Str::slug($post->title, '-');

      if ($slug != $post->slug) {
        $i = 1;

        while (Post::where("slug", $slug)->first()) {
          $slug = Str::slug($post->title, '-') . "-{$i}";
          $i++;
        }

        $post->slug = $slug;
      }
    }

    $post->content = $data["content"];
    $post->category_id = $data["category_id"];
    $post->published = isset($data["published"]);

    $post->save();

    return redirect()->route('posts.show', $post->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    $post->delete();

    return redirect()->route("posts.index");
  }
}
