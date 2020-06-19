<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        @foreach($books as $book)
        <li>{{$book->name}} -- {{$book->lastCheckout->borrowed_at->diffForHumans()}} -- {{$book->lastCheckout->user->name}}</li>
        @endforeach
    </ul>
</body>

</html>