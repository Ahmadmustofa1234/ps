<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi  Akun</title>
</head>
<body>
    
    <p>Halo <b>{{$user['name']}}</b></p>
    <br>
    <p>Berikut adalah data anda</p>

    <table>
        <tr>
            <td>
                Full nama
            </td>
            <td>:</td>
            <td>{{$user['name']}}</td>
        </tr>
        <tr>
            <td>
                Role
            </td>
            <td>:</td>
            <td>{{$user['role']}}</td>
        </tr>
        
        <br><br><br>
        <center>
            <h3>Click di bawah ini unruk Reset Password akun anda</h3>
            @component('mail::button',['url'=>url('reset/' . $user->remember_token)]);
                Reset Password
            @endcomponent
        </center>
    </table>
</body>
</html>