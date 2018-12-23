<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Photo;
use App\Category;
use Auth;
use Session;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsEditRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $user = Auth::user()->id;
        $input = $request->all();
        $input['user_id'] = $user;
        //return $input;

        if($file = $request->file('photo_id'))
        {
            $name = time().'_'.$file->getClientOriginalName();
            $photo = Photo::create(['file'=>$name]);
            $file->move('images/',$name);
            $input['photo_id'] = $photo->id;
        }

        //return $input;
        Post::create($input);
        Session::flash('msg','Post has been created.');
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        $input = $request->all();
        if($file = $request->file('photo_id'))
        {
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images/', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }
        //return $input;
        $post = Post::findOrFail($id);
        $post->update($input);
        Session::flash('msg','Post has been updated.');
        return redirect('admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if(file_exists(public_path().$post->photo->file))
            unlink(public_path().$post->photo->file);
            
        $post->delete();
        Session::flash('msg','Post has been deleted.');
        return redirect('admin/posts');
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->where('is_active',1)->get();
        return view('post', compact('post','comments'));
    }
}
