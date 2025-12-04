<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                @if (session('alert'))
                    <div class="alert alert-danger">{{session('alert')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="col-4 mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="password" class="form-label">Password :</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
