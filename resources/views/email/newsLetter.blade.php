<!DOCTYPE html>

<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('resources/views/frontend_style/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/views/frontend_style/css/font.css') }}">
    <link rel="shortcut icon" href="{{ asset('resources/views/frontend_style/images/logoicon.png') }}" type="image/png">

    <style>
        .c_view_content table {
            padding: 50px;
            margin: auto;
        }

        td.logo {
            text-align: center;
            margin-bottom: 25px;
        }

        td img {
            width: 300px;
        }
    </style>
</head>


<body>

    <div class="wrapper_1400">
        <div class="container-1200">
            <div class="c_view_content">
                <table border="0" cellspacing="0" cellpadding="0" ;>
                    <tr>
                        <td class="logo">
                            <img src="https://diyarnaa.com/style_files/frontend/img/logo.png">
                        </td>
                    </tr>
                    <tr>
                        <td class="c_ttile">
                            {{-- <h2> Newsletter Title </h2> --}}
                            <h3>{{ isset($data->title) ? $data->title : null }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td class="c_body">
                            {{-- <h2> Newsletter Description </h2> --}}

                            <p>
                                {!! isset($data->newsletter) ? $data->newsletter : null !!}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="c_footer">
                            {{-- <h2>Newsletter Link </h2> --}}
                            <p style="border-radius: 3px; font-size: 19px;
                            color: #fff;
                            background: #6A9BCC;
                            border: 1px solid #6A9BCC;
                            transition: 0.5s;
                            padding: 6px 30px;
                            border-radius: 30px;
                            width: fit-content">
                                <a style="color: #fff;
                                text-decoration:none" href="{{ isset($data->link) ? $data->link : null }}">  رابط النشره الاخبارية </a>
                            </p>

                       



                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
