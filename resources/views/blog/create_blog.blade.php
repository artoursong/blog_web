<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/blog/createblog.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    @include('layout.header')
    <section>
        <div class="container py-5">
            <div class="col-lg-8 content-container">
                <form action="{{route('createBlog', Auth::user()->id)}}" method="post" enctype="multipart/form-data" class="update-form">
                    @csrf
                    <div class="info-content">
                        <div class="input-label-group">
                            <label for="">Blog Name</label>
                            <input name="title" type="text">
                        </div>

                        <div class="form-outline form-white mb-4 mt-4">
                            <label for="photo">Blog Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="form-control-file">
                        </div>
                        
                        <fieldset>
                            <legend>Choose your blog's categories</legend>
                            
                            @foreach($categories as $value)
                                <div>
                                    <input type="checkbox" name="categories[]" value="{{$value->id}}">
                                    <label for="scales">{{$value->name}}</label>
                                </div>
                            @endforeach
                        </fieldset>

                        <div class="form-group col-md-12 mt-3">
                            <label class="mb-2">Content</label>
                            <textarea name="content" class="form-control " id="editor1"></textarea>
                        </div> 
                    </div>
                    <div class="info-footer">
                        <button type="submit">Upload</button>
                    </div>
                </form>
                
            </div>
        </div>
    </section>

    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'content', {
        
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    } );
    </script>
    
</body>


</html>