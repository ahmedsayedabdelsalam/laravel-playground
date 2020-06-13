<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        @foreach($users as $user)
        <li>{{$user->name}} - {{$user->company->name}} - {{optional($user->last_login_at)->diffForHumans()}}</li>
        @endforeach
    </ul>
</body>

</html>