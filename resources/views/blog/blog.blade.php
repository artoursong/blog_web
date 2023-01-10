<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/blog/index.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    @include('layout.header')

    
    <div class="container content-container">
        <h1 class="content-header">{{$blog->title}}</h1>
        {!! $blog->content !!}
    </div>

</body>
</html>