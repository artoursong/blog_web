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
                <form action="" method="post" enctype="multipart/form-data" class="update-form">
                    @csrf
                    <div class="info-content">
                        <div class="input-label-group">
                            <label for="">Blog Name</label>
                            <input type="text">
                        </div>
                        
                        <fieldset>
                            <legend>Choose your blog's categories</legend>

                            <div>
                                <input type="checkbox" id="scales" name="scales" checked>
                                <label for="scales">News</label>
                            </div>

                            <div>
                                <input type="checkbox" id="horns" name="horns">
                                <label for="horns">Books</label>
                            </div>
                        </fieldset>

                        <div class="form-group col-md-12 mt-3">
                            <label class="mb-2">Content</label>
                            <textarea name="txtContent" class="form-control " id="editor1"></textarea>
                        </div> 
                    </div>
                    <div class="info-footer">
                        <button type="submit">Upload</button>
                    </div>
                </form>
                
            </div>
        </div>
    </section>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script> CKEDITOR.replace('editor1'); </script>
</body>


</html>