<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .repeater-item {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }

        .nested-repeater {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row d-flex justify-content-center">
            <div class="col-lg-11">
                <h2 class="text-start">Create a Course</h2>

                <form action="{{ route('store-courses') }}" method="POST" class="py-3">
                    @csrf

                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Course Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="1" placeholder="Enter Description" required></textarea>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mb-5">
                        <div class="col-lg-6">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-control">
                                <option value="">Select A Category</option>
                                <option value="filmmaking">Filmmaking</option>
                                <option value="web_development">Web Development</option>
                                <option value="date_science">Data Science</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter Price" required>
                        </div>
                    </div>

                    <!-- MODULE REPEATER -->
                    <div class="mb-3">
                        <h5>Modules</h5>
                        <div class="repeater">
                            <div data-repeater-list="modules">
                                <div data-repeater-item class="repeater-item">

                                    <div class="mb-3">
                                        <label class="form-label">Module Title</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="nested-repeater">
                                        <h6>Contents</h6>
                                        <div data-repeater-list="contents">
                                            <div data-repeater-item class="repeater-item">

                                                <div class="mb-2">
                                                    <label class="form-label">Content Title</label>
                                                    <input type="text" name="title" class="form-control" required>
                                                </div>

                                                <div class="mb-2">
                                                    <label class="form-label">Type</label>
                                                    <select name="type" class="form-select" required>
                                                        <option value="video">Video</option>
                                                        <option value="text">Text</option>
                                                        <option value="quiz">Quiz</option>
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <label class="form-label">Video URL</label>
                                                    <input type="text" name="video_url" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Video Length</label>
                                                    <input type="text" name="video_length" class="form-control">
                                                </div>

                                                <input data-repeater-delete type="button" class="btn btn-danger btn-sm mb-2" value="Delete Content" />

                                            </div>
                                        </div>

                                        <input data-repeater-create type="button" class="btn btn-secondary btn-sm" value="Add Content" />
                                    </div>

                                    <hr>
                                    <input data-repeater-delete type="button" class="btn btn-danger" value="Delete Module" />

                                </div>
                            </div>
                            <input data-repeater-create type="button" class="btn btn-primary my-3" value="Add Module" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success me-1">Save</button>
                    <a href="{{ route('courses') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.repeater/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'title': '',
                    'type': 'video'
                },
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    //if (confirm('Are you sure you want to delete this item?')) {
                    $(this).slideUp(deleteElement);
                    //}
                },
                repeaters: [{
                    selector: '.nested-repeater',
                    initEmpty: true,
                    defaultValues: {
                        'title': '',
                        'type': 'video'
                    },
                    show: function() {
                        $(this).slideDown();
                    },
                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                }]
            });
        });
    </script>
</body>

</html>