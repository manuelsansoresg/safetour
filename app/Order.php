<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = ['title', 'total_price', 'name', 'watsapp', 'pickuppoint_id', 'quantity', 'date', 'email', 'type_pay_id', 'token', 'status'];

    public static function getAll()
    {
        $tour = Order::select('tours.name', 'orders.name as name_client', 'total_price', 'email', 'watsapp', 'quantity', 'date', 'status', 'orders.type', 'orders.created_at')
                        ->join('type_pays', 'type_pays.id', '=', 'orders.type_pay_id')
                        ->join('pickuppoints', 'pickuppoints.id', '=', 'orders.pickuppoint_id')
                        ->join('tours', 'tours.id', '=', 'orders.tour_id')
                        ->orderBy('orders.created_at', 'desc')
                        ->get();
        return $tour;
    }

    public static function getTotal($request)
    {
        $price      = $request->price;
        $persons    = $request->persons;
        $payed_sel  = $request->payed;
        $payed      = TypePay::find($payed_sel);
        $type_price = $payed->price;

        $percent    = $type_price / 100;
        $subtotal   = $price * $percent;
        $total      = $price;
        if( $payed->type != '' ){
            $total   = ($payed->type == '-' ) ? $price - $subtotal : $price + $type_price;
        }
        $total = $total * $persons;
        return $total;
    }

    public static function setUpOrder($request, $total)
    {
        DB::enableQueryLog();
        $tour = Tour::where('slug', $request->tour_slug)->first();
        /*dd($tour);*/
        $order                     = new Order();
        $order->title              = 'Tour-'.$tour->name;
        $order->quantity           = $request->persons;
        $order->total_price        = $total;
        $order->email              = $request->email;
        $order->type_pay_id        = $request->payed;
        $order->name               = $request->name;
        $order->watsapp            = $request->name;
        $order->pickuppoint_id     = $request->point;
        $order->date               = $request->date;
        $order->tour_id            = $tour->id;
        $order->save();
/*        dd( DB::getQueryLog());*/
        return $order;
    }

    public static function updatePrefId($order_id, $pref_id)
    {
        $order          = Order::find($order_id);
        $order->pref_id = $pref_id;
        $order->update();
    }

    public static function updateApproved($request)
    {

        $order = Order::where('pref_id', $request->preference_id)->first();
        $order->status = $request->collection_status;
        $order->update();
    }

    public static function updateOnlyReservation($order_id)
    {
        $order           = Order::find($order_id);
        $order->status   = 'only reservation';
        $order->type     = 0;
        $order->update();
    }

}
