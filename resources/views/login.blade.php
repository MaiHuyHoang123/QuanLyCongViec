<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/309c2f83b7.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('/storage/css/main.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="d-flex main half">
        <div class="d-flex flex-column justify-content-center align-items-center w-50">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex flex-column w-75 justify-content-center align-items-center">
                <div class="txt-login w-75">Login to <span
                        style="	color: rgb(49 46 129);font-size: 2.25rem;
                    line-height: 2rem;">Kenna<span
                            style="color: rgb(96 165 250);font-weight: 300;font-size: 2.25rem;
                    line-height: 2rem;">Tech</span></span>
                </div>
                <form action="{{ route('login.post') }}" method="POST" class="w-75">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại"
                            name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu"
                            name="password">
                    </div>
                    <button type="submit" class="btn-login btn w-100">Log in</button>
                </form>

            </div>
        </div>
        <div style="background-image: url({{ Voyager::image(setting('site.banner_login')) }}); background-size: cover;" class="w-50"></div>
    </div>

</body>

</html>
