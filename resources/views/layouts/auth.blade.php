<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('assets/bootstraps/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/common/scss/auth.css')}}" rel="stylesheet" type="text/css">
    <title>@yield('title') - PAK</title>
    @yield('css-private')
</head>
<body>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-5 col-lg-7">
            <div class="card m-auto rounded-3 text-black border-gradient">
                <div class="card-body p-md-4 mx-md-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('assets/bootstraps/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/common/js/auth.js') }}"></script>
@yield('js-private')
</html>