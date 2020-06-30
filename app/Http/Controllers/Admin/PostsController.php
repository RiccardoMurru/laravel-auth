<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $auth_user = Auth::id();
        $posts = Post::where('user_id', $auth_user)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione
        $request->validate($this->validation_rules());

        // acquisizione dati
        $data = $request->all();
        $user_id = Auth::id();
        $title = $data['title'];
        $slug = Str::slug($title, '-');

        // store data
        $new_post = new Post;
        $new_post->fill($data);
        $new_post->user_id = $user_id;
        $new_post->slug = $slug;

        

        // store image
        $data['img_path'] = Storage::disk('public')->put('images', $data['img_path']);
        $new_post->img_path = $data['img_path'];

        $saved_post = $new_post->save();

        if ($saved_post) {

            return redirect()->route('admin.posts.show', $new_post->id)->with('save_success', $new_post->title);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
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
        $request->validate($this->validation_rules());

        // acquisizione dati
        $data = $request->all();
        $user_id = Auth::id();
        $title = $data['title'];
        $slug = Str::slug($title, '-');
        $data['user_id'] = $user_id;
        $data['slug'] = $slug;

        // set immagine
        if (!empty($data['img_path'])) {
            // delete vecchia immagine
            if (!empty($post->img_path)) {
                Storage::disk('public')->delete($post->img_path);
            }
            // store nuova immagine
            $data['img_path'] = Storage::disk('public')->put('images', $data['img_path']);
            $post->img_path = $data['img_path'];
        }

        $updated_post = $post->update();
        
        if ($updated_post) {

            return redirect()->route('admin.posts.show', $post->id)->with('update_success', $post->title);
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
        //
    }

    /**
     * Validation rules
     */
    private function validation_rules() {

        return [
            'title' => 'required',
            'body' => 'required',
            'img_path' => 'image'
        ];
    }
}
