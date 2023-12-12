<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Pago;

class TransbankController extends Controller
{
    public function __construct(){
        if( app()->environment('production')){
            WebpayPlus::configureForProduction(
                env('webpayplus_cc'),
                env('webpay_plus_api_key')
            );
        }
    }

    public function iniciar_compra(Request $request){
        $nueva_compra = new Pago();
        $nueva_compra->user_id=$request->input('user_id');
        $nueva_compra->monto=$request->input("monto");
        $nueva_compra->fecha_pago=date('Y-m-d');
        $nueva_compra->metodo='Electrónico';
        $nueva_compra->gestor='WebPay';
        $nueva_compra->save();
        $url_to_pay = self::start_web_pay_plus_transaction( $nueva_compra );

        return $url_to_pay;
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
        dd($pago->user_id);

        if( $confirmacion->isApproved() ){
            $pago->status = 2;
            $pago->update();

            return redirect( env('URL_FRONTEND_AFTER_PAYMENT')."?pago_id={$pago->id}");
        }else{
            return redirect( env('URL_FRONTEND_AFTER_PAYMENT')."?pago_id={$pago->id}" );
        }
    }
}
