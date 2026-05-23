<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device=width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-compatible" content="ie=edge">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Mon premier blog en Laravel</title>
    </head>
    <body>
        <h1>Nos articles</h1>
        <ul>
            @foreach ($articles as $article)
            <li>{{$article['title']}}</li>
            @endforeach
        </ul>
    </body>
</html>