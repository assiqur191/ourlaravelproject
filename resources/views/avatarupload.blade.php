<!-- resources/views/avatar/upload.blade.php -->
<head>
    <link rel="stylesheet" href="{{ asset('css/avatarupload.css') }}">
</head>
<x-layout>
    <div class="container">
        <form action="/avatarupload" method="post" enctype="multipart/form-data" class="form"> <!--enctype is use for manage the file -->
            
            @csrf
            <h2 class="form-title">Upload Your Avatar</h2>

            <div class="form-group">
                <label for="image" class="form-label">Choose an image:</label>
                <input type="file" name="image" accept="image/*" class="form-input" required>
                @error('image')
                <p class="alert small alert-danger shadow-sm">pick a file (size <=3)</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>
    </div>
</x-layout>

{{-- {{ route('upload.image') }} --}}