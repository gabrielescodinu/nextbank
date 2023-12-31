<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Log::info('File size: ' . $image->getSize());
            $imageName = $image->hashName();
            $image->move(public_path('images'), $imageName);
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('posts.index');
    }


    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete(public_path('images/' . $post->image));
            }
            
            $image = $request->file('image');
            $post->image = $image->hashName();
            $image->move(public_path('images'), $post->image);
        }

        $post->save();

        return redirect()->route('posts.index');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
