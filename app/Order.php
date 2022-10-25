<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = ['title', 'total_price', 'name', 'watsapp', 'pickuppoint_id', 'quantity', 'date', 'email', 'type_pay_id', 'token', 'status'];

    public static function getAll()
    {
        $tour = Order::select('tours.name',  'orders.name as name_client', 'total_price', 'email', 'watsapp', 'quantity', 'date', 'status', 'orders.type', 'orders.created_at')
                        ->join('type_pays', 'type_pays.id', '=', 'orders.type_pay_id')
                        ->join('pickUpPoints', 'pickUpPoints.id', '=', 'orders.pickuppoint_id')
                        ->join('tours', 'tours.id', '=', 'orders.tour_id')
                        ->orderBy('orders.created_at', 'desc')
                        ->get();
        return $tour;
    }

    public static function getById($order_id)
    {
        DB::enableQueryLog();
        $order = Order::select('tours.id', 'slug', 'tours.name as name', 'orders.name as name_user', 'pickUpPoints.name as pays_name', 'type_pay_id', 'watsapp', 'tours.name as name_tour', 'quantity as persons', 'date', 'email', 'total_price')
                    ->join('type_pays', 'type_pays.id', '=', 'orders.type_pay_id', 'left')
                    ->join('pickUpPoints', 'pickUpPoints.id', '=', 'orders.pickuppoint_id', 'left')
                    ->join('tours', 'tours.id', '=', 'orders.tour_id')
                    ->where('orders.id', $order_id )
                    ->first();

        return $order;
    }

    public static function getTotal($request)
    {
        $kids         = $request->kids;
        $persons      = $request->persons;
        $payed_sel    = $request->payed;
        $tour_slug    = $request->tour_slug;

        $tour         = Tour::where('slug', $tour_slug)->first();
        $price_person = $tour->price;
        $price_kids   = $tour->price_kids;


        $payed      = TypePay::find($payed_sel);
        $type_price = $payed->price;

        $percent    = $type_price / 100;

        $price_adult  = $persons * $price_person;
        $price_kids   = $kids * $price_kids;

        $suma    = $price_adult + $price_kids;

        if($payed_sel == 1){ //online
            $sub_total = ($suma * $percent );
            $total = $suma - $sub_total;
        }else{

            $total   = ($payed->type == '+' ) ? $suma + $type_price  : $suma;
        }

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
        $order->number_kids        = $request->kids;
        $order->total_price        = $total;
        $order->email              = $request->email;
        $order->type_pay_id        = $request->payed;
        $order->name               = $request->name;
        $order->watsapp            = $request->watsapp;
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
