<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Pago;
use App\Models\Cobro;


class TransbankController extends Controller
{
    public function __construct(){
        if( app()->environment('production')){
            WebpayPlus::configureForProduction(
                env('webpayplus_cc'),
                env('webpay_plus_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciar_compra(Request $request){

        $user_id = $request->input('user_id');
        $id = $request->input('id');

        if($user_id !== null){
            if($id !== null){
                $nueva_compra = Pago::find($id);
            }else{
                $nueva_compra = new Pago();
                $nueva_compra->user_id=$request->input('user_id');
                $nueva_compra->monto=$request->input("total");
                $nueva_compra->fecha_pago=date('Y-m-d');
                $nueva_compra->metodo='Electrónico';
                $nueva_compra->gestor='WebPay';
                $nueva_compra->save();
            }
            $url_to_pay = self::start_web_pay_plus_transaction( $nueva_compra );

            return redirect($url_to_pay);
        }else{
            return response()->json([ 'respuesta'=>'1. No se ha podido realizar la compra, por favor intentelo nuevamente.']);
        }
    }

    public function start_web_pay_plus_transaction( $nueva_compra ){
        $transaction = (new Transaction)->create(
            $nueva_compra->id,
            $nueva_compra->user_id,
            $nueva_compra->monto,
            route('confirmar_pago')

        );

        $url = $transaction->getUrl().'?token_ws='.$transaction->getToken();
        return $url;
    }

    public function confirmar_pago(Request $request){
        $confirmacion = (new Transaction)->commit( $request->get('token_ws') );

        $pago = Pago::where('id', $confirmacion->buyOrder)->first();
        $cobro = Cobro::where('user_id', $pago->user_id);

        if( $confirmacion->isApproved() ){
            $pago->status = 2;
            $pago->updated_at = now();
            $pago->update();

            $cobro->update(['pagado' => true]);


            $pago = Pago::find($pago->id);
            return view('transaccion.show', compact('pago'));
        }else{
            $pago = Pago::find($pago->id);
            return view('transaccion.show', compact('pago'));
        }
    }
}
