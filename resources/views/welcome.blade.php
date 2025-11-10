<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
</head>

<body>
    <h1>Trang chủ</h1>
    <div>
        <a href="{{ route('users.comment', ['id' => 1, 'comment_id' => 2]) }}">Comment</a> |
        <a href="{{ route('admin.products') }}">admin products</a> |
        <a href="{{ route('admin.posts') }}">admin post</a>
    </div>
</body>

</html>
