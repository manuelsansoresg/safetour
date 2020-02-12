<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Order;
use App\Pickuppoint;
use App\Tour;
use App\TourImages;
use App\TypePay;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use stdClass;

class HomeController extends Controller
{

    protected $path_image;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->path_image = '/img/tour';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function landing()
    {
        $tours      = Tour::getAll();
        $tour_input = $tours;
        $path       = $this->path_image;
        $lbl        = Tour::getTags($tours);
        return view('welcome', compact('tours', 'path', 'lbl', 'tour_input'));
    }

    public function show($slug)
    {
        $tours      = Tour::getBySlug($slug);
        $tour_input = Tour::getAll();
        $path       = $this->path_image;
        $lbl        = Tour::getTags($tour_input);
        return view('welcome', compact('tours', 'path', 'lbl', 'tour_input'));
    }

    public function setbanner()
    {
       $images = TourImages::getAll();
        return response()->json($images);
    }

    public function preorder($name, Request $request)
    {
        //dd($request->all());
        $tour            = Tour::select('name', 'slug')->where('slug', $name)->first();
        $type_pays       = TypePay::all();
        $percent_online  = TypePay::where('name', 'payed on line')->first();
        $points          = Pickuppoint::all();

        $data = array(
            'persons'           => $request->persons[0],
            'date'              => $request->date[0],
            'price'             => $request->price[0],
            'total'             => $request->total[0],
            'percent_online'    => $percent_online->price,
            'id_percent_online' => $percent_online->id,


        );


        //dd($request->slug[0]);

        $tour_input = Tour::getAll();
        $lbl        = Tour::getTags($tour_input);

        return view('preorder', compact('tour', 'data', 'type_pays', 'percent_online', 'points', 'tour_input', 'lbl'));
    }

    public function calculate(Request $request)
    {
        $total = Order::getTotal($request);

        $data = array('total' => price($total));

        return response()->json($data);
    }

    public function onlyReservation(Request $request)
    {

    }

    public function btnPay(OrderRequest $request)
    {
        //dd($request->all());
        //dd($request->all());
        $total = Order::getTotal($request);

        /* pago */
        $allowedPaymentMethods = config('payment-methods.enabled');

        /*$request->validate([
            'payment_method' => [
                'required',
                Rule::in($allowedPaymentMethods),
            ],
            'terms' => 'accepted',
        ]);*/

        $order = Order::setUpOrder($request, $total);

        if($request->type_reservation == 1){
            $url = $this->generatePaymentGateway(
            //$request->get('payment_method'),
                'credit_card',
                $order
            );

            /* pago */
            $pref_id = explode('=', $url)[1];
            Order::updatePrefId($order->id, $pref_id);
            $data = array('total' => price($total), 'url' => $url );
        }else{
            $data = array('total' => price($total), 'url' => '/checkout/only-reservation/'.$order->id );
        }

        return response()->json($data);
    }

    /*protected function setUpOrder($request){
        $obj = new stdClass;
        $obj->id = 1;
        $obj->title = $request->slug[0];
        $obj->total_price = $request->total_price[0];
        $obj->featured_img = '';
        $obj->email = '';
        return $obj;
    }*/

    protected function generatePaymentGateway($paymentMethod, Order $order) : string
    {
        $method = new \App\PaymentMethods\MercadoPago;

        return $method->setupPaymentAndGetRedirectURL($order);
    }

}
