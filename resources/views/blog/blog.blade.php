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
        
        <hr></hr>
        <div class="comment-container">
            <div class="section-comment">
                <h2>Comment</h2>

                <form method="post" action="{{route('addComment', $blog->id)}}">
                    @csrf
                    <textarea name="comment">Your Comment</textarea>

                    <div class="submit-comment">
                        <button type="submit">Comment</button>
                    </div> 
                </form>
                 

                <hr></hr>

                <div class="comment-content">
                    <div class="comment">
                        <img src="{{asset('images/'. Auth::user()->image_url)}}" alt="">
                        <div>
                            <div class="user-comment">{{Auth::user()->username}}</div>
                            <div class="comment-text">Lứa này của Việt Nam không cóng như lứa Huỳnh Đức, Hồng Sơn. Tất nhiên nhìn thực tế thì Tháilan 10, Vietnam mới 7. Dù sao cũng ủng hộ Vietnam vô địch để tri ân Thầy Park...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>
</html>