<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Not Allowed</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .content {
            width: 60%;
        }

        .content img {
            width: 150px;
        }

        .content a {
            background: #fab216;
            color: rgb(0, 0, 0);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="content">
        <img src="{{ asset('adminassets/img/padlock.png') }}" alt="">
        <h2>You dont have permission to access this page</h2>
        <a href="{{ url('/') }}">Homepage</a>
    </div>

</body>
</html>
