<!DOCTYPE html>
<html lang="en">

<head>
  @yield('title')
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  @include('includes.web-head')
  @yield('style')
</head>

<body>

  @include('includes.web-nav')

  @yield('content')

  @include('includes.web-footer')
</body>

</html>