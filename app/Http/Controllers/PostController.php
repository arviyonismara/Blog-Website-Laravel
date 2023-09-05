<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::latest(); //mencari data latest

        // // pencarian judul
        // if (request('search')) { // 'search' ini berdasarkan name di form search
        //     $posts->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }
        if (request('author')) {
            $author = User::firstWhere('slug', request('author'));
            $title = ' by ' . $author->name;
        }

        return view("posts", [
            "title" => "All Posts" . $title,
            "active" => 'posts',
            // menggunakan eager loading, with
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString() //mengambil data yang terbaru dulu
            // "posts" => Post::all() // cara memanggil model nama_model::method()
        ]);
    }
    // public function show($slug)
    // variable yang menerima harus sama dengan variable yang dikirim
    public function show(Post $post)
    {
        // kode yang awalnya dari routing dipindah kesini
        return view('post', [
            "title" => "Single Post",
            "active" => 'posts',
            // "post" => Post::find($slug)
            // Route model bunding
            "post" => $post
        ]);
    }
}
