<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>{{ $post->title }}</title>
</head>

<body>
    <div class="container w-50">
        <h3>{{ $post->title }}</h3>
        <div>Ngày đăng: {{ $post->created_at }}</div>
        <p>
            {{ $post->content }}
        </p>
    </div>
</body>

</html>
