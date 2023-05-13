<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            /* margin-top: 80px; */
        }

        form {
            max-width: 800px;
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

        .label-small {
            color: #c4c4c4;
            font-size: 10px;
        }

        /* Styles for small devices */
        @media screen and (max-width: 576px) {
        form{
            margin-top:25rem;
            border-radius: 0;
        }
        input[type="submit"] {
            font-size: 14px;
        }
        }

        /* Styles for medium devices */
        @media screen and (min-width: 576px) and (max-width: 768px) {
        form{
            max-width: 500px;
        }
        input[type="submit"] {
            font-size: 16px;
        }
        }

        /* Styles for large devices */
        @media screen and (min-width: 768px) {
        .form-container {
            max-width: 800px;
        }
        }
    </style>
    <script>
        $(document).ready(function() {
            // Handle dropdown change event
            $('#type').on('change', function() {
                var selectedOption = $(this).val();

                if (selectedOption == "I") {
                    $(".assetsSection").hide();
                    $('.assetsSection').removeAttr('required');
                    $('.thumbnailSection').attr('required', 'required');
                    $(".thumbnailSection").show();

                }
                if (selectedOption == "T") {
                    $(".thumbnailSection").hide();
                    $(".assetsSection").show();
                    $('.thumbnailSection').removeAttr('required');
                    $('.assetsSection').attr('required', 'required');
                }
                if (selectedOption == "V") {
                    $(".thumbnailSection").show();
                    $(".assetsSection").show();
                    // $('.thumbnailSection').removeAttr('required');
                    $('.thumbnailSection').attr('required', 'required');
                    $('.assetsSection').attr('required', 'required');
                }

                // // Hide all form fields
                // $('#option1Fields, #option2Fields, #option3Fields').hide();

                // // Show the relevant form fields based on the selected option
                // $('#' + selectedOption + 'Fields').show();
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid row d-flex">


        <div class="col-lg-12">
            @include("sidebar/sidebar")
        </div>
        <div class="col-lg-12">
            @if(isset($code))
            @if($code == 200)
            <div class="alert alert-success" style="margin-top:100px" role="alert">
                @else
                <div class="alert alert-danger" style="margin-top:100px" role="alert">
                    @endif
                    {{$message}}
                </div>
                @endif
                <div class="container-fluid" style="margin-top:100px">

                    <div class="body" style="overflow-x: scroll;">

                        @if(isset($story))
                        <form action="{{ route('savePostEdit',$story->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @else
                            <form method="post" action="{{ route('savePost') }}" enctype="multipart/form-data">
                                @endif
                                @csrf
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
                                <div class="form-group row thumbnailSection">
                                    <label for="thumbnail" class="col-sm-4 col-form-label">Thumbnail</label>
                                    <div class="col-sm-8">
                                        @if(isset($story->thumbnail))
                                        <img src="{{ 'http://100.25.19.89/black101/public/storage'.str_replace('public', '', $story->thumbnail?:'') }}" style="height:100px;width:100px;" />
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
                                    <label for="headline" class="col-sm-4 col-form-label">Sub Title</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ isset($story) ? $story->sub_headline :'' }}" required name="headline" id="headline">
                                    </div>
                                </div>

                                <div class="form-group row assetsSection">
                                    <label for="assets" class="col-sm-4 col-form-label">Assets<label class="label-small">Enter URL for video and image or your Quote Text</label></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ isset($story) ? $story->url:''}}" required name="assets" id="assets">
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
                </div>
            </div>



</body>

</html>