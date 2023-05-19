<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<style>
    .navbar {
        top: 0;
        left: 0;
        right: 0;
        position: fixed;
        z-index: 1000;
    }

    .color {
        background-color: #77619e;
    }
</style>

<body>
    <div class="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark color">
            <a class="navbar-brand" href="#">Black History Hub</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end " id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/black101/public/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/black101/public/user">User List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/black101/public/allpost">View Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/black101/public/addPost">Add Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/black101/public/donate">Donation</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <script>
        // when the navbar toggler is clicked
        $('.navbar-toggler').click(function() {

            // toggle the "show" class on the navbar collapse
            $('.navbar-collapse').toggleClass('show');

            // toggle the "aria-expanded" attribute of the navbar toggler
            $(this).attr('aria-expanded', function(index, attr) {
                return attr == 'true' ? 'false' : 'true';
            });

            // toggle the icon of the navbar toggler
            $(this).find('.navbar-toggler-icon').toggleClass('fa-bars fa-times');

            // when the user clicks outside the navbar collapse
            $(document).on('click', function(event) {
                if ($('.navbar-collapse').hasClass('show') && !$(event.target).closest('.navbar-collapse').length && !$(event.target).is('.navbar-toggler')) {
                    // hide the navbar collapse
                    $('.navbar-collapse').removeClass('show');
                    // set the "aria-expanded" attribute of the navbar toggler to "false"
                    $('.navbar-toggler').attr('aria-expanded', 'false');
                    // set the icon of the navbar toggler to the default icon
                    $('.navbar-toggler-icon').removeClass('fa-times').addClass('fa-bars');
                }
            });
        });
    </script>
</body>

</html>