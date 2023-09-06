<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');

        // validasi untuk inputan post
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024', // set max ukuran image dalam bentuk kb
            'body' => 'required'
        ]);

        // validasi jia ada image maka akan si store, jika tidak ada maka aman2 saja
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200); //strip_tags fungsi untuk menghilangkan tag2 html yang dibawa oleh trix editor

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post Successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //buat rulesnya dulu
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // cek slug
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        // inisialisasi $validatedData dengan $rules
        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200); //strip_tags fungsi untuk menghilangkan tag2 html yang dibawa oleh trix editor

        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post Successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //delete image
        if ($post->image) {
            Storage::delete($post->image);
        }

        // delete di table database
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been delete');
    }

    // eloquent sluggable
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title); //createSlug mengambil dari class Post mengambil field slug, kemudian title
        return response()->json(['slug' => $slug]);
    }
}
