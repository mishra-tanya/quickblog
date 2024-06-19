<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card {
            width: 400px;
        }
        .icon {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text icon"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text icon"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <button type="submit" class="btn btn-primary w-100">Login</button><br>
                    <div class="mb-3 mt-3 ">
                        Not Registered? <a href="{{ route('register') }}" class="text-dark">Register</a> Now
                    </div>
                </form>
                <hr>
                <div class="mb-3 mt-3 text-center">
                 <a href="{{ url('/') }}" class="text-dark" style="text-decoration: none">Back To Home Page</a> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>
