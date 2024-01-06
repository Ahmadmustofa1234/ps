<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi  Akun</title>
</head>
<body>
    
    <p>Halo <b>{{$details['name']}}</b></p>
    <br>
    <p>Berikut adalah data anda</p>

    <table>
        <tr>
            <td>
                Full nama
            </td>
            <td>:</td>
            <td>{{$details['name']}}</td>
        </tr>
        <tr>
            <td>
                Role
            </td>
            <td>:</td>
            <td>{{$details['role']}}</td>
        </tr>
        <tr>
            <td>
               Website
            </td>
            <td>:</td>
            <td>{{$details['website']}}</td>
        </tr>
        <tr>
            <td>
              Tanggal Registrasi
            </td>
            <td>:</td>
            <td>{{$details['datetime']}}</td>
        </tr>
        <br><br><br>
        <center>
            <h3>Click di bawah ini unruk Verifikasi akun anda:</h3>
            <a href="{{$details['url']}}">Verifikasi</a>
        </center>
    </table>
</body>
</html>