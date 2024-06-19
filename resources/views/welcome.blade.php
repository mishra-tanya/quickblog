<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QuickBlog</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .quick {
            font-size: 60px;
            font-weight: bolder;
        }

        .wel {
            background: #bfcbf4;
            padding: 40px;
            background-color: #e5e5f7;
            opacity: 0.1;
            background-color: #e5e5f7;
            opacity: 1;
            background-image: radial-gradient(circle at center center, #444df70c, #e5e5f7), repeating-radial-gradient(circle at center center, #444df70a, #444df70c, 8px, transparent 16px, transparent 8px);
            background-blend-mode: multiply;
            color: black;
        }

        img {
            height: 220px;
        }

        .card-deck {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            flex: 0 0 auto;
            margin: 10px;
        }
    </style>
</head>

<body>
    @include('navbar')

    <div class="wel">
        <h1 class="text-center mt-3 text-dark"><b><i>Welcome to</i></b></h1>
        <p class="quick text-center text-dark"><i>QuickBlog</i></p>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="card-deck">
                @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card" style="border: none;">
                        <img src="{{ $blog->image ? asset('storage/images/' . $blog->image) : asset('imnot.png') }}"
                            class="card-img-top .blog-image" alt="Blog Image">
                        <div class="card-body">

                            <h5 class="card-title text-center text-capitalize">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="mt-2"
                                    style="text-decoration: none"> {{ $blog->title }}</a>
                            </h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <p class="card-text text-capitalize text-secondary"><b>{{ $blog->type }}</b></p>
                                </div>
                                <div class="col-4 text-end">
                                    <p class="card-text"><small
                                            class="text-muted"><b>{{ $blog->created_at->format('M d, Y') }}</b></small>
                                    </p>
                                </div>
                            </div>
                            
                            <?php 
                            $firstSection = json_decode($blog->content, true)[0];
                            $contentWords = substr($firstSection['content'],0,164);
                            ?>
                            <p class="card-title text-capitalize">{{ $contentWords }}...
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="mt-2" style="text-decoration: none">Read More</a>
                            </p>
                            

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
