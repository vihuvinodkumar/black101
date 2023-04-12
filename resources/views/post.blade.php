<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list of post</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                    <a class="nav-link" href="/dashboard">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user">user</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/allpost">post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/addPost">Add New Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/donation">donation</a>
                </li>

            </ul>
        </div>
    </nav>
    <div class="container-fluid" style="margin-top:100px">
        <table>
            <tbody>
                <tr>
                    <th><strong>Id</strong></th>
                    <th><strong>Type</strong></th>
                    <th><strong>headline</strong></th>
                    <th><strong>Sub headline</strong></th>
                    <th><strong>overview</strong></th>
                    <th><strong>URL</strong></th>
                    <th><strong>publshed at</strong></th>
                    <th><strong>Edit</strong></th>
                </tr>

                <tr>
                    @foreach ($posts as $post)
                <tr>
                    <td><a href="editpost/{{ $post->id }}">{{ $post->id }}</a></td>
                    <td>{{ $post->type }}</td>
                    <td>{{ $post->headline }}</td>
                    <td>{{ $post->sub_headline }}</td>
                    <td style="min-width:150px;">{{ $post->overview }}</td>
                    <td><a href="{{ $post->url }}">Link</a></td>
                    <td>{{ $post->publish_at }}</td>
                    <td style="width:100px;"><a href="editpost/{{ $post->id }}">Edit</a></td>
                </tr>
                @endforeach
                </tr>

            </tbody>
        </table>

</body>

</html>