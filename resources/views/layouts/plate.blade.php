
<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('Title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" crossorigin="anonymous">
<meta name="keywords" content="@stack('keywords')"/>
@include('layouts.Static.css')
@include('layouts.Static.custom')
</head>
<body >

@yield('content')
@include('layouts.Static.js')
</body>
</html>




