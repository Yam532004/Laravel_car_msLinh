<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
  <div class="row">
    <div class="col-md-6">
      <img class="card-img-top" src="{{ asset($car->images) }}" alt="">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h2 style="color: red; text-align:center; font-family:Verdana, Geneva, Tahoma, sans-serif">{{$car->model}}</h2>
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">ID</th>
              <td>{{$car->id}}</td>
            </tr>
            <tr>
              <th scope="row">Model</th>
              <td>{{$car->model}}</td>
            </tr>
            <tr>
              <th scope="row">Description</th>
              <td>{{$car->description}}</td>
            </tr>
            <tr>
              <th scope="row">Produced_on</th>
              <td>{{$car->produced_on}}</td>
            </tr>
            <tr>
              <td>
                <form action="{{route('cars.destroy', ['car' => $car->id])}}" method="POST">
                @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-primary">Delete</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>