<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Import Js  -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="../js/updateImage.js"></script>
    <title>Add new car</title>
</head>

<body class="container">
    <h1 style="text-align: center;">Add new car</h1>
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <span style="color: red;">Add new product fail</span>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form style="width: 500px;" method="POST" action="{{route('cars.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                @if ($errors->has('name'))
                <label for="name" style="color: red;">Name: </label>
                @else
                <label for="name">Name: </label>
                @endif
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" placeholder="Enter name" value="{{ old('name') }}">
                @error('name')
                <span style="color: red;">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">

                @if ($errors->has('description'))
                <label for="description" style="color: red;">Description: </label>
                @else
                <label for="description">Description: </label>
                @endif

                <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{ old('description') }}">
                @error('description')
                <span style="color: red;">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">

            @if ($errors->has('model'))
                <label for="model" style="color: red;">Model: </label>
                @else
                <label for="model">Model: </label>
                @endif

                <input type="text" class="form-control" id="model" name="model" placeholder="model" value="{{ old('model') }}">
                @error('model')
                <span style="color: red;">{{$message}}</span>
                @enderror
            </div>


            <div class="form-group">
            @if ($errors->has('produced_on'))
                <label for="produced_on" style="color: red;">Produced_on: </label>
                @else

                <label for="produced_on">Produced_on: </label>
                @endif
                <input type="date" class="form-control" id="produced_on" name="produced_on" placeholder="produced_on" value="{{ old('produced_on') }}">
                @error('produced_on')
                <span style="color: red;">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" @error('model') style="color: red;" @enderror>Image: </label>

                <input type="file" id="imageInput" name="image" onchange="previewImage(event)" accept="image/*">

                <img src="" alt="Preview Image" id="imagePreview" style="display: none; max-width: 200px; max-height: 200px">

                @error('image')
                <span style="color: red;">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>

<script>
    function previewImage(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; 
                var imageUrl = URL.createObjectURL(input.files[0]);
                localStorage.setItem('selectedImage', imageUrl);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</script>

</html>