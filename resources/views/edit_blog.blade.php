<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Edit Blog Post</h1>
                <form method="POST" enctype="multipart/form-data" action="{{ route('blogs.update', $blog->slug) }}">
                    @csrf
                    @method('PUT') 
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ $blog->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        @foreach ($blog->content as $index => $section)
                            <div class="section">
                                <label for="section-title-{{ $index }}" class="form-label">Section Title</label>
                                <input type="text" class="form-control" id="section-title-{{ $index }}" name="sections[{{ $index }}][title]" value="{{ $section['title'] }}" required>
                    
                                <label for="section-content-{{ $index }}" class="form-label">Section Content</label>
                                <textarea class="form-control" id="section-content-{{ $index }}" name="sections[{{ $index }}][content]" rows="5" required>{{ $section['content'] }}</textarea>
                            </div>
                        @endforeach
                        @error('sections.*.title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update Blog</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
