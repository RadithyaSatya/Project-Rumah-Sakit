@extends('template')

@section('title', 'Update Profile Photo')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Update Profile Photo</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="photo" class="form-label">Choose New Profile Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" onchange="previewImage(event)" required>
                    @error('photo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="preview" class="form-label">Preview</label>
                    <div>
                        <img id="preview" src="{{ asset(Auth::user()->path_poto ?? 'images/defaultpp.jpg') }}" alt="Current Photo" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Update Photo</button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
