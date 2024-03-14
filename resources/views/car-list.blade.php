<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Import Js  -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>

<body>
    <div>
        <h1 style="color: red; ;text-align: center;">Car-list of Am hii</h1>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <a class="btn btn-primary mt-3" href="{{ action([App\Http\Controllers\CarController::class, 'create']) }}" role="button">Create</a>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Description</th>
                    <th scope="col">Model</th>
                    <th scope="col">Produced On</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->description }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->produced_on }}</td>
                    <td><img style="height: 100px; width: 100px;" src="{{ asset($car->images) }}" alt=""></td>
                    <td>
                        <!-- Cach 3  -->
                        <a class="btn btn-primary" href="{{ action([App\Http\Controllers\CarController::class, 'show'], ['car' => $car->id]) }}" role="button">Detail</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ action([App\Http\Controllers\CarController::class, 'edit'], ['car' => $car->id]) }}" role="button">Update</a>
                    </td>
                   
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</body>

</html>