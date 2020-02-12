<?php
/*
include '../vendor/autoload.php';


function create_button($)
{
    MercadoPago\SDK::setAccessToken(env('MP_APP_ACCESS_TOKEN'));
    MercadoPago\SDK::setClientId(env('MP_APP_ID'));
    MercadoPago\SDK::setClientSecret(env('MP_APP_SECRET'));

    # Create a preference object
    $preference = new MercadoPago\Preference();

    # Building an item

    $item             = new MercadoPago\Item();
    $item->id         = "00001";
    $item->title      = "item";
    $item->quantity   = 1;
    $item->unit_price = 100;

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
        "success" => url('/')."/mercadp_pago/pago-success?token=" . $token_user,
        "failure" => url('/')."/mercadp_pago/pago-failure?token=" . $token_user,
        "pending" => url('/')."/mercadp_pago/pago-ending?token=" . $token_user
    );

    $preference->auto_return = "approved";

    $preference->save();


    $url_mercado_pago = $preference->sandbox_init_point;
    return $url_mercado_pago;
}



function generate_token()
{
    return str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789" . uniqid());
}*/
