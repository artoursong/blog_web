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
                    
                    </div>
                </div>
            </div>
                   
                    
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        window.blog_id = "{{$blog->slug}}";
    </script>
    <script type="text/javascript" src="{{asset('js/renderComment.js')}}"></script>
</body>
</html>