<?php

namespace App\Http\Controllers;

use DateTime;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('post.index', ['posts' => $posts]);
    }
    
    public function create(Request $request)
    {
        if(isset($request->image))
        { 
            $path = $request->file('image')->store('/public/img');
            $image = basename($path);
        }
        else
        {
            $image = '';
        }
        $this->validate($request, Post::$rules);
        $post = new Post;
        $form = [
            'title'       => $request->title,
            'text'        => $request->text,
            'image'       => $image,
            'regist_date' => new DateTime(),
            'update_date' => new DateTime()
        ];
        $post->timestamps = false;
        unset($form['_token']);
        $post->fill($form)->save();
        return redirect('/post')->with('message', '投稿しました。');
    }
    public function adminList(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('post.admin_list', ['posts' => $posts]);
    }

    public function delete(Request $request)
    {
        Post::find($request->id)->delete();
        return redirect('/post/admin_delete');
    }

    public function edit(Request $request)
    {
        $post = Post::find($request->id);
        return view('post.admin_edit', ['form' => $post]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = Post::find($request->id);
        $post->title = $request->input('title');
        $post->text  = $request->input('text');
        $post->update_date  = new Datetime();

        if($request->hasFile('image'))
        { 
            $path = $request->file('image')->store('/public/img');
            $image = basename($path);
            $post->image = $image;
        }

        if(($request->imgDel) === "true")
        {
            $image = "";
            $post->image = $image;
        }

        $post->timestamps = false;
        unset($post['_token']);
        $post->update();
        return redirect('/post/admin_update');
    }
}
