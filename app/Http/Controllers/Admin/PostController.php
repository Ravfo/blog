<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.edit')->only('edit','update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id');//crea un array con id,valor
        $tags = Tag::all();        
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //return Storage::put('posts', $request->file('file'));
       
        $post = Post::create($request->all());
        if($request->file('file')){
            $url = Storage::put('posts', $request->file('file'));
            $post->image()->create([
                'url'=>$url,
                
            ]);
        }
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        return redirect(route('admin.posts.edit',$post));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author',$post);//Checa las policies
        $categories = Category::pluck('name','id');//crea un array con id,valor
        $tags = Tag::all();       
        return view('admin.posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        if($request->file('file')){
            $url = Storage::put('posts',$request->file('file'));

            if($post->image){
                Storage::delete($post->image->url);
                $post->image->update([
                    'url'=>$url
                ]);
            }else{
                $post->image()->create([
                    'url'=>$url
                ]);
            }
        }
        if($request->tags){
            $post->tags()->sync($request->tags);//sincroniza la colecci??n, si no existe el registro lo agrega 
                                                //y elimina tambi??n si alguno se quita de la colecci??n
        }
        return redirect(route('admin.posts.edit',$post))->with('info','El Post se actualiz?? con ??xito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('admin.posts.index',$post))->with('info','El Post se elimin?? con ??xito');
    }
}
