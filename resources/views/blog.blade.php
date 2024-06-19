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
        .blog-container {
            margin: 20px auto;
            padding: 20px;
        }
        .blog-image {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border-radius: 4px;
        }
        .comment {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    @include('navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 blog-container">
                <h2 class="text-center text-capitalize"><b>{{ $blog->title }}</b></h2>
                <div class="row align-items-center"><hr>
                    <div class="col">
                        <p class="card-text text-capitalize text-secondary"><b>{{ $blog->type }}</b></p>
                    </div>
                    <div class="col text-end">
                        <p class="card-text"><small class="text-muted"><b>{{ $blog->created_at->format('M d, Y') }}</b></small></p>
                    </div>
                </div>
                @if($blog->image)
                    <img src="{{ asset('storage/images/'.$blog->image) }}" class="blog-image mb-4" alt="{{ $blog->title }}">
                @endif <br>
                @foreach (json_decode($blog->content, true) as $section)
                <h3>{{ $section['title'] }}</h3>
                <p>{{ $section['content'] }}</p>
                <br>
            @endforeach
            
<br><br><br><br>

                <div class="comments-section">
                    <h3 style="text-decoration: underline">Comments</h3>
                    <br>
                    <div id="commentsContainer">
                        @foreach($blog->comments->reverse() as $comment)
                            <div class="comment mb-3">
                                <p ><strong class="text-capitalize">{{ $comment->user->name }}</strong>: <span>{{ $comment->content }}</span><span class="text-muted float-end">{{ $comment->created_at->diffForHumans() }}</span></p>
                            </div>
                            <hr>
                        @endforeach

                        @auth
                            <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Add a comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Post Comment</button>
                            </form>
                        @else
                            <p><a href="{{ route('login') }}">Log in</a> to post a comment.</p>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
