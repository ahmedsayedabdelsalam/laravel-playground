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
<form action="/posts" method="GET">
    <input name="search" type="text" value="{{request('search')}}" placeholder="Search...">
    <input type="submit" value="Submit">
</form>
<br>
<br>
<ul>
    @foreach($posts as $post)
        <li>{{$post->score}} -- {{$post->title}} -- {{$post->body}}</li>
    @endforeach
    {{$posts->withQueryString()->links()}}
</ul>
</body>
</html>
