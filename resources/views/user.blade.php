<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <title>list of user</title>

</head>
<script>
    $(document).ready(function() {
        $('#userTable tbody tr td:nth-child(5)').each(function() {
            var originalDate = $(this).text(); // Get the original date

            // Convert the date to the desired format (e.g., DD/MM/YYYY)
            var formattedDate = moment(originalDate).format('DD/MM/YYYY');

            $(this).text(formattedDate); // Update the cell content with the formatted date
        });
    })
</script>

<body>
    <div class="container-fluid">
        <div class="row">

        <div class="col-lg-12">
            @include("sidebar/sidebar")
        </div>
        <div class="col-lg-12">
            <div class="table-responsive" style="overflow-x: scroll;">
            <div class="container-fluid m-4">
                <table class="table table-hover" id="userTable">
                    <tbody>
                        <tr>
                            <th><strong>Id</strong></th>
                            <th><strong>Photo</strong></th>
                            <th><strong>Name</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Created At</strong></th>
                            <th><strong>Verified</strong></th>
                        </tr>

                        <tr>
                            @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->id }}</td>
                            <td><img src="{{ 'http://100.25.19.89/black101/public/storage/'.str_replace('public', '', $user->profile_photo) }}" style="height:50px;width:50px;" /></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                @if($user->is_verified==1)
                                <span class="text-success text-center">Verified</span>
                                @else
                                <span class="text-secondary text-center">Unverified</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 container d-flex row">
                <div class="table-responsive" style="overflow-x: scroll;">
                    <div class="container-fluid m-4" style="margin-top: 100px;">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th><strong>Id</strong></th>
                                    <th><strong>Photo</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Email</strong></th>
                                    <th><strong>Created At</strong></th>
                                    <th><strong>Verified</strong></th>
                                </tr>

                                <tr>
                                    @foreach ($users as $user)
                                <tr>

                                    <td>{{ $user->id }}</td>
                                    <td><img src="{{ 'http://100.25.19.89/black101/public/storage/'.str_replace('public', '', $user->profile_photo) }}" style="height:50px;width:50px;" /></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @if($user->is_verified==1)
                                        <span class="text-success text-center">Verified</span>
                                        @else
                                        <span class="text-secondary text-center">Unerified</span>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


</body>

</html>