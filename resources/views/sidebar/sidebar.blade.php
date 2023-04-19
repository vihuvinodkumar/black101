<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Side Navigation Bar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/dashboard.js') }}">
    <link rel="stylesheet" href="{{ asset('js/sidebar/sidebar.js') }}">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-pyramid'></i>
            <span class="logo_name">DashBoard</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/black101/public/dashboard">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Category</a></li>
                </ul>
            </li>



            <li>
                <a href="/black101/public/user">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">User</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">User</a></li>
                </ul>
            </li>
            <li>
                <a href="/black101/public/allpost">
                    <i class='bx bx-line-chart'></i>
                    <span class="link_name">All Post</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">All Post</a></li>
                </ul>
            </li>

            <li>
                <a href="/black101/public/addPost">
                    <i class='bx bx-compass'></i>
                    <span class="link_name">Add A new Post</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Add A new Post</a></li>
                </ul>
            </li>
            <li>
                <a href="/black101/public/donation">
                    <i class='bx bx-history'></i>
                    <span class="link_name">Donation</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Donation</a></li>
                </ul>
            </li>

        </ul>
    </div>

</body>

</html>