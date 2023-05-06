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

    <title>list of user</title>
</head>

<body>
    <div class="container-fluid d-flex row">

        <div class="col-lg-2">
            @include("sidebar/sidebar")
        </div>
        <div class="col-lg-10">
            <div class="container-fluid m-4">
                <table class="table table-hover">
                <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Donated At</th>
                <th>Amount</th>
                <th>Transaction ID</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donates as $donate)
                <tr>
                    <td>{{ $donate->id }}</td>
                    <td>{{ $donate->user_id }}</td>
                    <td>{{ $donate->donated_at }}</td>
                    <td>{{ $donate->amount }}</td>
                    <td>{{ $donate->transaction_id }}</td>
                    <td>{{ $donate->created_at }}</td>
                    <td>{{ $donate->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
                </table>
            </div>
        </div>

    </div>


</body>

</html>