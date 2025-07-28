<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Courses List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Courses</h2>
            <a href="{{ route('create-courses') }}" class="btn btn-primary">+ Create New Course</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($courses->isEmpty())
        <div class="alert alert-info">No courses found.</div>
        @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Modules</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->category }}</td>
                    <td>{{ $course->modules?->count() ?? 0 }}</td>
                    <td>{{ $course->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>
</body>

</html>