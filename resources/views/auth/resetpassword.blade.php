<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Reset Password Baru</title>
</head>
<body>
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        @if(Session::has('danger'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('danger') }}
        </div>
    @endif
    
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">Reset Password</h5>
            <form action="" method="POST">
              {{@csrf_field()}}
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
                @error('password')
                <div class="text-danger">{{ $message }}</div>
          @enderror
              </div>
              <div class="mb-3">
                <label for="cpassword" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" >
                @error('cpassword')
                <div class="text-danger">{{ $message }}</div>
          @enderror
              </div>
              <button type="submit" class="btn btn-primary">Ubah Password</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
