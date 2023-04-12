<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('js/dashboard.js') }}">
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
    <!-- exta animation -->
    <div class="carousel">
        <div class="image-1"></div>
        <div class="image-2"></div>
        <div class="carousel-content">
            <div class="carousel-overlay">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/537051/whiteTest4.png">
            </div>
            <!-- TOP CONTENT -->
            <div class="content content-top">
                <h2>Black 101</h2>
                <h3>A Random Mesage</h3>
                <h4>......</h4>
                <div class="logo">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/537051/opus-attachment.png">
                </div>
            </div>
            <!-- END TOP CONTENT -->

            <!-- BOTTOM CONTENT -->
            <div class="content content-bottom">
                <h2>habitant</h2>
                <h3>ut eget</h3>
                <h4>Nam imperdiet</h4>
                <div class="logo">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/537051/opus-attachment.png">
                </div>
            </div>
            <!-- END BOTTOM CONTENT -->
        </div>
    </div>

</body>

</html>