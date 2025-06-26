<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }}</title>

    @include('admin.include.css')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        @yield('content')

    </div>

    @include('admin.include.loginRegisterJs')
</body>

</html>