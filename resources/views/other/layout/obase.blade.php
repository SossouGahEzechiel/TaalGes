<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        h1,h6{
            text-align: center;
        }
        form{
            padding-left: 200px;
            padding-right: 200px;
        }
    </style>
    <title>TAALGES | {{$title ?? ''}}</title>
</head>
<body>
    @include('other.layout._onav')
    {{-- section mb-5 p-4 --}}
    <div class="container">
        @yield('content')
    </div>
    <script src="//code.jquery.com/jquery.js"></script>
    @include('flashy::message')
</body>
</html>