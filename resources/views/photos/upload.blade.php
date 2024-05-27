<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload photos</title>
</head>

<body>

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @elseif ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Photo Name:</label>
        <input type="text" name="name" id="name">
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <label for="image">Image:</label>
        <input type="file" name="data" id="image">
        <button type="submit">Submit</button>
    </form>
</body>

</html>