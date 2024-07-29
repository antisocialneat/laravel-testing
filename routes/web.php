<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/pricing', function () {
    return view('pricing', ['title' => 'Pricing']);
});

Route::get('/posts', function () {
    // $posts = Post::with(['author', 'category'])->latest()->get(); // Fetching dengan eager load
    $posts = Post::latest()->get();
    return view('posts', ['title' => 'About', 'posts' => $posts]);
});

Route::get('/posts/{post:slug}', function(Post $post){

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function(User $user){

    // $posts = $user->posts->load('author', 'category'); // Fetching dengan lazy eager load
    return view('posts', ['title' => count($user->posts). ' Articles by '.$user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function(Category $category){

    // $posts = $category->posts->load('author', 'category'); // Fetching dengan lazy eager load
    return view('posts', ['title' => 'Articles in: '.$category->name, 'posts' => $category->posts]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});