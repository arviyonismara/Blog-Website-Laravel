@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Post</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-5">
          @method('put')
            @csrf
            {{-- title --}}
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title', $post->title) }}">{{-- menambahkan parameter kedua di old() agar menampilkan value dari postingan yang lama --}}
              @error('title')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Slug --}}
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $post->slug) }}">
              @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>

            {{-- Category --}}
            <div class="mb-3">
              <label for="category" class="form-label">category</label>
              <select class="form-select" name="category_id">
                @foreach($categories as $category)
                {{-- pengkondisian untuk menampilkan old value pada categori --}}
                  @if(old('category_id', $post->category_id) == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                  @else 
                    <option value="{{ $category->id }}">{{ $category->name }}</option>              
                  @endif
                @endforeach
              </select>
            </div>

            {{-- Trix Editor --}}
            <div class="mb-3">
              <label for="body" class="form-label">body</label>
              @error('body')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}"> 
              <trix-editor input="body"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Edit post</button>
        </form>
    </div>
    
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        // event handler
        title.addEventListener('change', function(){
            fetch('/dashboard/posts/checkSlug?title=' + title.value) //kirim data title ke checkSlug
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>

@endsection