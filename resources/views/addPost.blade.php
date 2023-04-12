<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>Add Post</title>
    <style>
        .body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* Style the form fields */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            height: 35px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-family: sans-serif;
        }


        input[type="file"],
        select,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-family: sans-serif;
        }

        input[type="file"] {
            border: none;
        }

        textarea {
            height: 150px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .header {
            height: 200px;
        }

        .left {
            text-align: center;
            padding: 30px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Black 101</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/black101/public/dashboard">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/black101/public/user">user</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/black101/public/allpost">post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/black101/public/addPost">Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/black101/public/donation">donation</a>
                </li>

            </ul>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top:100px">

        <div class="body">
            @if(isset($story))
            <form action="{{ route('savePostEdit',$story->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @else
                <form method="post" action="{{ route('savePost') }}" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="form-group row">
                        <label for="thumbnail" class="col-sm-4 col-form-label">Thumbnail</label>
                        <div class="col-sm-8">
                            @if(isset($story->thumbnail))
                            <img src="{{ 'http://localhost:8000/storage/'.str_replace('public', '', $story->thumbnail?:'') }}" style="height:100px;width:100px;" />
                            <input type="file" class="form-control-file" {{ $story->thumbnail ?: "required" }} name="thumbnail" id="thumbnail">
                            @else
                            <input type="file" class="form-control-file" required name="thumbnail" id="thumbnail">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label">Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ isset($story) ? $story->headline :'' }}" required name="title" id="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label">Type</label>
                        <div class="col-sm-8">
                            <select class="form-control" required name="type" id="type">
                                @if(isset($story))
                                <option value="V" {{ $story->type=="V"?"selected":"" }}>Video</option>
                                <option value="I" {{ $story->type=="I"?"selected":"" }}>Image</option>
                                <option value="T" {{ $story->type=="T"?"selected":"" }}>Quote</option>
                                @else
                                <option value="V">Video</option>
                                <option value="I">Image</option>
                                <option value="T">Quote</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assets" class="col-sm-4 col-form-label">Assets</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ isset($story) ? $story->url:''}}" required name="assets" id="assets">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="headline" class="col-sm-4 col-form-label">sub Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" value="{{ isset($story) ? $story->sub_headline :'' }}" required name="headline" id="headline">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="overview" class="col-sm-4 col-form-label">Overview</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" required id="overview" name="overview" rows="3"> {{ isset($story) ? $story->overview :""}} </textarea>
                        </div>
                    </div>
                    @if(isset($story))
                    <div><input type="text" class="form-control" value="{{ date($story->publish_at) }}" disabled /></div>
                    @else
                    <div class="form-group row">
                        <label for="publish_at" class="col-sm-4 col-form-label">Publish At</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" required name="publish_at" id="publish_at">
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="cft" class="col-sm-4 col-form-label">Charactor focus of today</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required name="cft" value="{{isset($story)? $story->cft:'' }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>

        </div>

</body>

</html>