<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function create(Request $request)
    {
        // Validate the input
        // $validatedData = $request->validate([
        //     'title' => 'required|max:255',
        //     'content' => 'required',
        // ]);

        // Create a new post
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json(['status'=>true,'post' => $post], 200);
    }

    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json([
            'message'=>'Post Updated Successfully!!',
            'post'=>$post
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message'=>'Post Deleted Successfully!!'
        ]);
    }
}
