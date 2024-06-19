<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>
    @include('navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 class="text-center text-capitalize mb-4">Hi, {{ Auth::user()->name }}</h1>
                <hr>
                <h1 class="text-center">Create Blog</h1>
                <form method="POST" enctype="multipart/form-data" action="{{ route('blogs.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Select a type</option>
                            <option value="Food blogs">Food blogs</option>
                            <option value="Travel blogs">Travel blogs</option>
                            <option value="Health and fitness blogs">Health and fitness blogs</option>
                            <option value="Technical">Technical</option>
                            <option value="Lifestyle blogs">Lifestyle blogs</option>
                            <option value="Fashion and beauty blogs">Fashion and beauty blogs</option>
                            <option value="Photography blogs">Photography blogs</option>
                            <option value="Personal blogs">Personal blogs</option>
                            <option value="DIY craft blogs">DIY craft blogs</option>
                            <option value="Parenting blogs">Parenting blogs</option>
                            <option value="Music blogs">Music blogs</option>
                            <option value="Business blogs">Business blogs</option>

                            <option value="Art and design blogs">Art and design blogs</option>
                            <option value="Book and writing blogs">Book and writing blogs</option>
                            <option value="Personal finance blogs">Personal finance blogs</option>
                            <option value="Interior design blogs">Interior design blogs</option>
                            <option value="Sports blogs">Sports blogs</option>
                            <option value="News blogs">News blogs</option>
                            <option value="Movie blogs">Movie blogs</option>
                            <option value="Religion blogs">Religion blogs</option>
                            <option value="Political blogs">Political blogs</option>
                        </select>
                        @error('type')
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

                    <div id="sections-container">
                        <div class="mb-3">
                            <label for="section-title" class="form-label">Section Title</label>
                            <input type="text" class="form-control" name="sections[0][title]" required>
                            @error('sections.*.title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <label for="section-content" class="form-label">Section Content</label>
                            <textarea class="form-control" name="sections[0][content]" rows="5" required></textarea>
                            @error('sections.*.content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <button type="button" class="btn btn-primary" onclick="addSection()">Add Section</button>
                    <button type="submit" class="btn btn-primary">Create Blog</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <hr><br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center mb-4">Your Blog Posts</h1>
                <table id="blog" class="table  table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $index => $blog)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-capitalize">{{ $blog->title }}</td>
                                <td class="text-capitalize">{{ $blog->type }}</td>
                                <td>
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('blogs.edit', $blog->slug) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('blogs.destroy', $blog->slug) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this blog post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#blogs').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <script>
        let sectionIndex = 1; 
    
        function addSection() {
            var container = document.getElementById('sections-container');
            var sectionInput = `
                <div class="mb-3">
                    <label for="section-title" class="form-label">Section Title</label>
                    <input type="text" class="form-control" name="sections[${sectionIndex}][title]" required>
    
                    <label for="section-content" class="form-label">Section Content</label>
                    <textarea class="form-control" name="sections[${sectionIndex}][content]" rows="5" required></textarea>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', sectionInput);
            sectionIndex++; 
        }
    </script>
    

</body>

</html>
