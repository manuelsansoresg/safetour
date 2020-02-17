<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pickuppoint;
use App\Tour;
use App\TypePay;
use Barryvdh\DomPDF\PDF;
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

    public function pdf($order_id)
    {

        $order      = Order::getById($order_id);
        $tour       = Tour::find($order_id);

        $points     = Pickuppoint::all();
        $type_pays  = TypePay::all();
        $title      = $order->name;
        $bg         = 'bg-success';

        if($order->status == 'pendiente' ){
            $bg         = 'bg-warning';
        }

        $tour_input = Tour::getAll();
        $lbl        = Tour::getTags($tour_input);
        $data       = array('order' => $order, 'tour' => $tour , 'points'=> $points, 'type_pays' => $type_pays );
        $pdf = app('dompdf.wrapper');

        $pdf->loadView('mercado_pago.pdf', compact('tour', 'points', 'type_pays', 'order', 'title', 'bg', 'tour_input', 'lbl'));

        return $pdf->download('tour-receipt.pdf');
    }

    public function ipn(Request $request)
    {

    }

}
