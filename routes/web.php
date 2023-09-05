<?php


// use App\Models\Post;
// use App\Models\User;
use App\Models\Category;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
// use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// jika url = '/', otomatis mengarah ke halaman welcome. (cek folder views)
// Route::get('/', function () {
//     return view("welcome");
// });

// route buatan sendiri
Route::get('/', function () {
    return view("home", [
        "title" => "Home",
        "active" => "home"
    ]);
});

// mengirim data lewat route
Route::get('/about', function () {
    return view("about", [
        "title" => "About",
        "active" => "about",
        "name" => "Arvie Yonismara",
        "email" => "Arvi@gmail.com",
        "jurusan" => "arvi.jpg"
    ]);
});

// mengarahkan Route ke controller Post
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);
// tidak perlu menggunakan kode Routing clossure dibawah

// Route::get('/posts', function () {
//     return view("posts", [
//         "title" => "Posts",
//         "posts" => Post::all() // cara memanggil model nama_model::method()
//     ]);
// });

// halaman single post
// Route::get('posts/{slug}', [PostController::class, 'show']);
// tidak lagi menggunakan slug, dinamai bebas. disini kita namai post
// penamaan harus sama dengan yang ada di controller
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); //hanya bisa diakses oleh user yang belum ter otentikasi. 'guest' ini merupakan middleware bawaan dari laravel
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Route untuk eloquent sluggable
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');


//                                                 route model binding
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => "Post by Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author'),
//         // 'category' => $category->name
//     ]);
// });


// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => "Post by Author : $author->name",
//         'active' => 'posts',
//         'posts' => $author->posts->load('category', 'author'), //lazy eagerloading, load
//     ]);
// });
