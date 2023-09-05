@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row my-3">
        <div class="col-lg-8">
            <h1 class="mb-3">{{ $post->title }}</h1>
            
            <button href="/dashboard/posts" class="btn btn-success"><i class="bi bi-arrow-left"></i> Back to my Posts</button>
            
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
            
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button href="/dashboard/posts" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash3"></i>Delete</button>
            </form>

            <img src="https://source.unsplash.com/1200x400/?{{ $post->category->name }}" class="img-fluid mt-3" alt="{{ $post->category->name }}">

            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>

        </div>
    </div>
</div>

@endsection