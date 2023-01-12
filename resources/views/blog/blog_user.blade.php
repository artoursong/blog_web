<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/blog/blog_user.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="./css/fontawesome-free-6.2.0-web/css/all.min.css">
    <title>Document</title>
</head>
<body>
    @include('layout.header')
    <div class="container">
        <h1>YOUR BLOG</h1>
        <a href="{{URL::route('getCreateForm')}}">
            <i class="fas fa-plus"></i>
        </a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($status)
                    <div class="alert alert-danger" role="alert">
                        {!! $status !!}
                    </div>
                @endif
                @foreach ($blogs as $item)
                    <tr>
                        <th style="width: 20%" scope="row">{{$item->title}}</th>
                        <td style="width: 20%">{{$item->subtitle}}</td>
                        <td style="text-align: center">
                            @if(is_null($item->image_url) || !file_exists( public_path().'/images/'.$item->image_url ))
                            <a class="px-3 me-2" href="">
                            <img style="width: 200px; height: 200px" src="{{asset('images/default-thumbnail.jpg')}}" alt="">
                            </a>
                            @else
                            <a class="px-3 me-2" href="">
                            <img style="width: 200px; height: 200px" src="{{asset('images/'. $item->image_url)}}" alt="">
                            </a>
                            @endif
                        </td>
                        <td class="action">
                            <a href="{{ URL::route('getBlog', $item->slug) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ URL::route('editBlog', [Auth::user()->id, $item->slug])}}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="{{ URL::route('deleteBlog', [Auth::user()->id, $item->id])}}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>