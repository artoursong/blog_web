<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/home/index.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
@include('layout.header')

    <div class="row container blog-layout">
        <div class="leftcolumn">
            @foreach ($blogs as $item)
                <a href="{{ URL::route('getBlog', $item->slug) }}" class="card card-hover">
                    <h2>{{$item->title}}</h2>
                    <h5>Title description, Dec 7, 2017</h5>
                    <img src="{{asset('images/'. $item->image_url)}}" class="fakeimg" style="height:200px;">
                    <p>Some text..</p>
                </a>
            @endforeach
        </div>
        <div class="rightcolumn">
            <div class="card">
                <h2>About Me</h2>
                <div class="fakeimg" style="height:100px;">Image</div>
                <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
            </div>
            <div class="card">
                <h3>Popular Post</h3>
                <div class="fakeimg">Image</div><br>
                <div class="fakeimg">Image</div><br>
                <div class="fakeimg">Image</div>
            </div>
            <div class="card">
                <h3>Follow Me</h3>
                <p>Some text..</p>
            </div>
        </div>
    </div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>
</html>