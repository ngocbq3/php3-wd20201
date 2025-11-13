<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Trang chủ</title>
</head>

<body>
    <div class="container">
        <nav>
            <a href="{{ route('home') }}">Trang chủ</a>

            @foreach ($categories as $cate)
                <a href="{{ route('posts.list', $cate->id) }}">{{ $cate->name }}</a>
            @endforeach
        </nav>
        <div class="row">
            <h2>Bài viết mới nhất</h2>
            @foreach ($posts as $post)
                <div class="col-4 mb-3">
                    <a href="{{ route('posts.detail', $post->id) }}">
                        <h3>{{ $post->title }}</h3>
                    </a>
                    <div>
                        {{ $post->description }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
