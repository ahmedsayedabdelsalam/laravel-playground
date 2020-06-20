<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        @foreach($features as $feature)
            <li>{{$feature->name}} -- {{$feature->type}} -- {{$feature->comments_count}} comments -- {{$feature->likes_count}} likes -- ({{$feature->likes_count + ($feature->comments_count * 2)}})</li>
        @endforeach
        {{$features->withQueryString()->links()}}
    </ul>
</body>
</html>
