<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .custom-form {
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            padding: 25px 25px;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <div class="container custom-form">
        <div class="row ">
            <div class="col-lg-12">
                 {{--  --}}
                 @if(Session::has('danger'))
                 <div class="alert alert-danger" role="alert">
                     {{ Session::get('danger') }}
                 </div>
             @endif
             
                  {{--  --}}
                @if(Session::get('success'))
                <div class="alert alert-success" role="alert">
                <ul>
                <li>{{Session::get('success')}}</li>
                </ul>
                </div>
                @endif
 {{--  --}}
 {{--  --}}
                <!-- form -->
                <form action="{{route('auth.password')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email Anda</label>
                        <input class="form-control" type="email" id="emailaddress" name="email" name="email">
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    
                   {{--  --}}
                   <button type="submit" class="btn btn-primary">Lupa Password</button>

                    
                </form>
                <br>
                <center>

                 
                    <br>
                    <a href="{{route('login')}}">Kembali Ke Login</a>
                </center>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
