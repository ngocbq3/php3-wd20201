@extends('admin.layouts.main')

@section('title')
    Cập nhật bài viết
@endsection

@section('content')
    <div class="container w-50">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" @selected($cate->id === $post->category_id)>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label> <br>
                <img src="{{ Storage::URL($post->image) }}" width="100" alt=""> <br>
                <input type="file" name="image" id="" class="form-control">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control">{{ $post->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Content</label>
                <textarea name="content" rows="10" class="form-control">{{ $post->content }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">List</a>
            </div>
        </form>
    </div>
@endsection
