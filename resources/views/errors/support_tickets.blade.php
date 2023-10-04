<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="{{ asset('dashboard_files/bootstrap/css/bootstrap.min.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blue Ray For Web Solutions</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md ">
                <img class="img-thumbnail image-preview " style="border: 1px solid #3ea23e; width: 20% !important;" src="{{ asset('images_default/blueray_logo.jpg') }}" alt="">
            </div>
            <div class="m-b-md-12">
                <h1 style="color: blue;">Blue Ray For Web Solutions</h1>
                <hr>
                <h1 style="color: blue;">Ticket Number : ( @isset ($end_error_ticket){{ $end_error_ticket->id }}@endisset )</h1>
                <hr>
                <h2 style="color:red">Please contact the technical support department to solve this problem</h2>
                {{-- <h2 style="color: royalblue;">Landline :+962 6 534 2861 || Mobile : +962 79 851 7788 || E-mail : support@bluerayws.com</h2> --}}
                <h2><a href="{{ route('welcome',1) }}">Back To Home Page</a></h2>
            </div>
        </div>
    </div>
</body>

</html>