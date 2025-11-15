@extends('admin.layouts.main')

@section('title')
    Trang danh sách
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">
                        <a href="" class="btn btn-primary">Create</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ $post->image }}" width="100" alt="">
                        </td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            edit/delete
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
@endsection
