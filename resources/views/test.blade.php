<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>Trang demo view</h1>

    @foreach ($posts as $post)
        <div>
            <a href="{{ route('posts.detail', $post->id) }}">
                <h3>{{ $post->title }}</h3>
            </a>
            <div>
                {{ $post->description }}
            </div>
            <hr>
        </div>
    @endforeach

    <div>
        {{ $posts->links() }}
    </div>
</body>

</html>
