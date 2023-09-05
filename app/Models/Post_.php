<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul posts pertama",
            "slug" => "judul-post-pertama",
            "author" => "Arvie Yonismara",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas distinctio dolorem dolorum omnis, rerum animi ipsam et, nam dolor, consectetur deleniti! Aliquam cumque non architecto adipisci est vel, nesciunt commodi?"
        ],
        [
            "title" => "Judul posts pertama",
            "slug" => "judul-post-kedua",
            "author" => "Dani Firman",
            "body" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima recusandae, ipsum consequatur ullam aspernatur animi mollitia fuga molestias iste pariatur vel ea corrupti sapiente vitae asperiores cumque delectus officiis voluptas?"
        ],
    ];

    public static function all()
    {
        return collect(self::$blog_posts); //menggunakan :: karena property static. tidak mengunakan ->
        // collect() merubah menjadi collection
    }
    public static function find($slug)
    {
        $posts = static::all();

        // looping postingan
        // $post = [];
        // foreach ($posts as $p) {
        //     if ($p["slug"] === $slug) {
        //         $post = $p;
        //     }
        // }

        return $posts->firstWhere('slug', $slug); // dengna ini tidak perlu loopingan diatas
    }
}
