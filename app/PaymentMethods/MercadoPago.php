<?php

namespace App\PaymentMethods;

use App\Order;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPago
{
    public function __construct()
    {
        SDK::setClientId(
            config("payment-methods.mercadopago.client")
        );
        SDK::setClientSecret(
            config("payment-methods.mercadopago.secret")
        );
    }


    public function setupPaymentAndGetRedirectURL(Order $order): string
    {

        $preference = new Preference();

        $item             = new Item();
        $item->id         = $order->id;
        $item->title      = $order->title;
        $item->quantity   = $order->quantity;
        $item->unit_price = $order->total_price;

        $preference->items = array($item);

        $preference->payment_methods = array(
            "excluded_payment_types" => array(
                array("id" => "bank_transfer")
            ),
            "installments" => 12
        );

        $token_user =  csrf_token();
        $_SESSION['token_user'] = trim($token_user);

        $preference->back_urls = array(
            "success" => route('checkout.thanks'),
            "pending" => route('checkout.pending'),
            "failure" => route('checkout.error'),
        );

        $preference->auto_return = "approved";
        $preference->notification_url = route('ipn');

        $preference->save();

        $url_mercado_pago = $preference->sandbox_init_point;



        return  $url_mercado_pago;

        //dd($order);
        # Create a preference object
        //$preference = new Preference();

        # Create an item object
        /*$item = new Item();
        $item->id = $order->id;
        $item->title = $order->title;
        $item->quantity = 1;
        $item->currency_id = 'MXN"';
        $item->unit_price = $order->total_price;
        $item->picture_url = '';*/



        # Create a payer object
        //$payer = new Payer();
        //$payer->email = $order->preorder->billing['email'];
        //$payer->email = $order->email;

        # Setting preference properties
        /*$preference->items = [$item];
        $preference->payer = $payer;*/



        # Save External Reference
        /*$preference->external_reference = $order->id;
        $preference->back_urls = [
            "success" => route('checkout.thanks'),
            "pending" => route('checkout.pending'),
            "failure" => route('checkout.error'),
        ];*/



       // $preference->auto_return = "all";
        //$preference->notification_url = route('ipn');
        # Save and POST preference
        //$preference->save();


        /*if (config('payment-methods.use_sandbox')) {
            return $preference->sandbox_init_point;
        }*/
        /*dd($preference);
        return $preference->init_point;*/
    }

    function generate_token()
    {
        return str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789" . uniqid());
    }

}
