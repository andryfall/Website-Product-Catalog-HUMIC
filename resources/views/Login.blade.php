<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Page</title>
    <style>
        body {
            background-image: url('{{url('/images/Login-bg.png')}}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
        }

        .left-image {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .logo {
            max-width: 120px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }

        .login-form {
            padding: 40px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-form h2 {
            color: #c5181f;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .btn-primary {
            background-color: #c5181f;
            border-color: #c5181f;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
        }

        .right-column {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .left-image img {
            max-width: 90%;
            height: auto;
        }
    </style>
</head>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show fixed-top mx-auto text-center mt-3" role="alert" style="width: 90%; max-width: 500px; z-index: 1050;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show fixed-top mx-auto text-center mt-3" role="alert" style="width: 90%; max-width: 500px; z-index: 1050;">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-6 left-image d-none d-md-flex">
            </div>
            <div class="col-md-6 right-column">
                <div class="login-form">
                    <img src="{{url('/images/logo-humic-text.png')}}" alt="Logo" class="logo">
                    <h2 class="text-center">Login</h2>
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
