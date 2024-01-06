<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use ParagonIE\Sodium\Compat;
use App\Models\User;
class OrderController extends Controller
{
    //
    public function index(){
        return view("home.index");
    }
public function checkout(Request $request){
    $user = User::find($request->id_user);
  $request->request->add(['total'=>$request->total,'id_user'=>$request->id_user,'id_psikolog'=>$request->id_psikolog]);
  $order=Order::create($request->all());
  // Set your Merchant Server Key
\Midtrans\Config::$serverKey = config('midtrans.servey_key');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;

$params = array(
    'transaction_details' => array(
        'order_id' => $order->id,
        'gross_amount' => $order->total,
    ),
    'customer_details' => array(
        'first_name' => $user->name,
       
        'email' => $user->email,
        
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);

return view('home.transaksi', compact('snapToken', 'order'));

  
}
public function callback(Request $request){
    $servey_key=config('midtrans.servey_key');
    $hashed=hash("sha512",$request->order_id.$request->status_code.$request->gross_amount.$servey_key);
    if($hashed==$request->signature_key){

        if($request->transaction_status=='settlement'){
            $order=Order::find($request->order_id);
            $order->update(['status'=>'Paid']);

        }
    }
}
public function invoice($id){
    $order=Order::find($id);
    return view('home.invoice',compact('order'));

}
}
