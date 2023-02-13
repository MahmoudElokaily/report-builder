<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Okaily</title>
</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1 style="color: green">{{$title}} Report</h1>
        </div>
        <table class="table">
            <thead>
            <tr>
                @foreach($headers as $header)
                    <th scope="col">{{$header}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                @foreach($fields as $field)
                    <tr>
                        @foreach($field as $item)
                            <th scope="row">{{$item}}</th>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
