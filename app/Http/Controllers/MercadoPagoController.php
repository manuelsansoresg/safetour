<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pickuppoint;
use App\Tour;
use App\TypePay;
use Illuminate\Http\Request;

class MercadoPagoController extends Controller
{
    public function thanks(Request $request)
    {
        Order::updateApproved($request);

        $order      = Order::where('pref_id', $request->preference_id)->first();
        $tour       = Tour::find($order->tour_id);
        $points     = Pickuppoint::all();
        $type_pays  = TypePay::all();
        $title      = $request->collection_status;
        $bg         = 'bg-success';
        $type       = 1;

        $tour_input = Tour::getAll();
        $lbl        = Tour::getTags($tour_input);

        return view('mercado_pago.status', compact('tour', 'points', 'type_pays', 'order', 'title', 'bg', 'tour_input', 'lbl', 'type'));
    }

    public function pending(Request $request)
    {
        Order::updateApproved($request);

        $order      = Order::where('pref_id', $request->preference_id)->first();
        $tour       = Tour::find($order->tour_id);
        $points     = Pickuppoint::all();
        $type_pays  = TypePay::all();
        $title      = $request->collection_status;
        $bg         = 'bg-warning';
        $type       = 1;

        $tour_input = Tour::getAll();
        $lbl        = Tour::getTags($tour_input);

        return view('mercado_pago.status', compact('tour', 'points', 'type_pays', 'order', 'title', 'bg', 'tour_input', 'lbl', 'type'));
    }

    public function error(Request $request)
    {
        Order::updateApproved($request);

        $order      = Order::where('pref_id', $request->preference_id)->first();
        $tour       = Tour::find($order->tour_id);
        $points     = Pickuppoint::all();
        $type_pays  = TypePay::all();
        $title      = $request->collection_status;
        $bg         = 'bg-danger';
        $type       = 1;

        $tour_input = Tour::getAll();
        $lbl        = Tour::getTags($tour_input);

        return view('mercado_pago.status', compact('tour', 'points', 'type_pays', 'order', 'title', 'bg', 'tour_input', 'lbl', 'type'));
    }

    public function only_reservation($order_id)
    {
        Order::updateOnlyReservation($order_id);

        $order      = Order::find($order_id);
        $tour       = Tour::find($order->tour_id);
        $points     = Pickuppoint::all();
        $type_pays  = TypePay::all();
        $title      = '';
        $bg         = 'bg-success';
        $type       = 0;

        $tour_input = Tour::getAll();
        $lbl        = Tour::getTags($tour_input);

        return view('mercado_pago.status', compact('tour', 'points', 'type_pays', 'order', 'title', 'bg', 'tour_input', 'lbl', 'type'));
    }

    public function ipn(Request $request)
    {

    }

}
