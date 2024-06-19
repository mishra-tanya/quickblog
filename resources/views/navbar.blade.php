<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickBlog</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="shadow-md">
        <nav class="navbar navbar-expand-lg navbar-light p-3 bg-light shadow-sm">
            <a class="navbar-brand" href="#">QuickBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="visually-hidden">(current)</span></a>
                    </li>
                    
                    @guest
                
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ url('login') }}">Login</a>
                    </li>
                    @endguest
                
                    @auth
                    @if(Auth::user()->role==1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/dashboard') }}">Admin Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('admin/dashboard#blog') }}">Your Blogs</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    @endauth
                
                </ul>
            
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
