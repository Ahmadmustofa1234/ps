<?php

namespace App\Http\Controllers;

use App\Mail\AuthMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    // 
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'

        ],[
            'email.required'=>'Email wajib di isi',
            'password.required'=>'Password wajib di isi'

        ]);
        $infologin=[
            'email'=>$request->email,
            'password'=>$request->password

        ];
        if(Auth::attempt($infologin)){
            
            if(Auth::user()->email_verified_at!=null){
             
                    return redirect()->route('dashboard')->with('success','Halo User','Anda berhasil login');
                

                //return('Login Sukses');
            }else{
                Auth::logout();
                return redirect()->route('login')->with('danger','Akun Anda Belum Aktif');
            }

        }else{
            return redirect()->route('login')->with('danger','Email atau kandi salah');
        }
    }
    // 
    public function create(Request $request){
        $str=Str::random(100);
       $request->validate([
        'name'=>'required|min:5',
        'email'=>'required|unique:users|email',
        'password' => 'required|min:6|confirmed',
       

       ],[
        'name.required' => 'Nama Wajib di Isi',
        'name.min' => 'Nama Wajib 5 Karakter',
        'email.required' => 'Email Wajib di isi',
        'email.unique' => 'Email telah terdaftar',
        'password.required' => 'Password Wajib di isi',
        'password.min' => 'Password minimal 6 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
      
       ]);
      

       $inforegister=[
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,
        
       
        'verify_key'=>$str,
       ];
      
       User::create($inforegister);

       $details=[
        'name'=> $inforegister['name'],
        'role'=>'User',
        'website'=>'Pertemanan Sejiwa',
        'datetime'=>date('Y-m-d H:i:s'),
        'url'=>'http://'.request()->getHttpHost()."/"."verify/".$inforegister[
            'verify_key'
        ],
       ];
       
       Mail::to($inforegister['email'])->send(new AuthMail($details));
       return redirect()->route('login')->with('success','Link verifikasi telah dikirim ke email yang anda daftarkan');
    }
    function verify($verify_key){
        $keyCheck=User::select('verify_key')->where('verify_key',$verify_key)->exists();
     
        if($keyCheck){
            $user=User::where('verify_key',$verify_key)->update(['email_verified_at'=>date('Y-m-d H:i:s')]);
            return redirect()->route('login')->with('success','Verifikasi Berhasil. akun anda sudah aktif');
        }else{
            return redirect()->route('login')->with('danger','keys tidak valid pastikan sudah melakuakn registrasi')->withInput();
        }
    }
    function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','Anda berhasil logout');
    }
    // public function register(){
    //     $title = 'Halaman Registrasi';
    //     return view('auth.register')->with('title', $title);
    // }
    //password
    public function forgot(){
        $title="Lupa Password";
        return view('auth.forgotpassword')->with('title',$title);
    }
    
    
    public function sendResetLinkEmail(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);
        $user=User::getEmailSingle($request->email);
        if(!empty($user)){
            $user->remember_token=Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->route('auth.forgot')->with('success','Silahkan cek email anda');
        }else{
            return redirect()->route('auth.forgot')->with('danger', 'Email belum terdaftar');
        }
    
    }
    public function Reset($remember_token){
        $user=User::getTokenSingle($remember_token);
        if(!empty($user)){
            $data['user']=$user;
            return view('auth.resetpassword',$data);

        }else{
            
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('Token Tidak Valid');
                document.location.href = '" . route('auth.forgot') . "';
            });
        </script>";
        
        
        }
    }

    
    public function resetPassword($token, Request $request)
    {
        $request->validate([
            
            'password' => 'required|min:6',
            
    
           ],[
           
            'password.required' => 'Password Wajib di isi',
            'password.min' => 'Password minimal 6 karakter',
           
           ]);
    
       if($request->password==$request->cpassword){
        $user=User::getTokenSingle($token);
        $user->password=Hash::make($request->password);
        $user->remember_token=Str::random(30);
        $user->save();
        return redirect('/')->with('success', 'Password Berhasil di Ubah');
        
       }else{
         return redirect()->back()->with('danger', 'Konfirmasi Password tidak cocok');
       }
    }
}
