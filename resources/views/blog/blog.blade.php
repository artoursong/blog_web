<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

                <form>
                    <textarea class="text-comment" name="comment">Your Comment</textarea>

                    <div class="submit-comment">
                        <button type="submit">Comment</button>
                    </div> 
                </form>
                 

                <hr></hr>

                <div class="comment-content">
                    <div class="comment"> 
                    @foreach ($comments as $item)
                        @if (substr_count($item->comments_parents, '.') == 0)
                        <div class="comment-parent comment-item">
                            <div class= "d-flex">
                                @if(is_null($item->image_url) || !file_exists( public_path().'/images/'.$item->image_url ))
                                <img src="{{asset('images/user.svg')}}" alt="">
                                @else
                                <img src="{{asset('images/'. $item->image_url)}}" alt="">
                                @endif
                                <div class="comment-data d-flex">
                                    <p class="user-comment">{{$item->username}}</p>
                                    <p class="comment-text">{{$item->content}}</p>
                                </div>
                            </div>
                            <div class="action">
                                <a class="like" href="">like</a>
                                <a class="reply" alt="{{$item->id}}" href="">reply</a>
                                @if (Auth::check() && $item->user_id == Auth::user()->id)
                                    <a href="">edit</a>
                                @endif
                            </div>
                            <div class="reply-form" alt="{{$item->id}}"></div>
                        </div>
                        @elseif (substr_count($item->comments_parents,'.') == 1 )
                        <div class="comment-child comment-item" alt="{{$item->id}}">
                            <div class= "d-flex">
                                @if(is_null($item->image_url) || !file_exists( public_path().'/images/'.$item->image_url ))
                                <img src="{{asset('images/user.svg')}}" alt="">
                                @else
                                <img src="{{asset('images/'. $item->image_url)}}" alt="">
                                @endif
                                <div class="comment-data d-flex" id="{{$item->id}}">
                                    <p class="user-comment">{{$item->username}}</p>
                                    <p class="comment-text">{{$item->content}}</p>
                                </div>
                            </div>
                            <div class="action">
                                <a class="like" href="">like</a>
                                <a class="reply" alt="{{$item->id}}" href="">reply</a>
                                @if (Auth::check() && $item->user_id == Auth::user()->id)
                                    <a href="">edit</a>
                                @endif
                            </div>
                            <div class="reply-form" alt="{{$item->id}}"></div>
                        </div>
                        @else
                        <div class="comment-last-child comment-item" alt="{{$item->id}}">
                            <div class= "d-flex">
                                @if(is_null($item->image_url) || !file_exists( public_path().'/images/'.$item->image_url ))
                                <img src="{{asset('images/user.svg')}}" alt="">
                                @else
                                <img src="{{asset('images/'. $item->image_url)}}" alt="">
                                @endif
                                <div class="comment-data d-flex">
                                    <p class="user-comment">{{$item->username}}</p>
                                    <p class="comment-text">{{$item->content}}</p>
                                </div>
                                <div class="reply-form" alt="{{$item->id}}"></div>
                            </div>
                            <div class="action">
                                <a class="like" href="">like</a>
                                    <a class="reply" alt="{{$item->id}}" href="">reply</a>
                                @if (Auth::check() && $item->user_id == Auth::user()->id)
                                    <a href="">edit</a>
                                @endif
                            </div>
                            <div class="reply-form" alt="{{$item->id}}"></div>
                        </div>
                        @endif      
                    @endforeach
                    </div>
                </div>
            </div>
                   
                    
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        window.blog_id = "{{$blog->id}}";
        window.auth_id = "{{Auth::id()}}";
    </script>
    <script type="text/javascript" src="{{asset('js/renderComment.js')}}"></script>
</body>
</html>