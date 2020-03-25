<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $validationPost = [
        'title' =>'required|string|max:255',
        'subtitle' =>'required|string|max:255',
        'description'=>'required|string',
        'author'=>'required|string',
        'date'=>'required|date'

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();
      $request->validate($this->validationPost);
      $post = new Post;
      $post->fill($data);
      $saved = $post->save();

      if($saved) {
          
          $post = Post::orderBy('id','desc')->first();
           return redirect()->route('posts.show', compact('post'));

      }
      dd('Non salvato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)

    {
        if(empty($post)){
            abort('404');
        }
        return view('posts.edit', compact('post'));
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
        $post = Post::find($id);
        if (empty($post)) {
          abort('404');
        }
        $data = $request->all();
        $request->validate($this->validationPost);
        $updated = $post->update($data);
        if($updated) {
           //Ritorno alla index dell'item aggiornato
           $post = Post::find($id);
            return redirect()->route('posts.show', compact('post'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $id = $post->id;
        $delete = $post->delete();

        return redirect()->route('posts.index')->with("id", $id);
    }
}
