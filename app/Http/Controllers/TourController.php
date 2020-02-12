<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourRequest;
use App\Tour;
use App\TourImages;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $path_image;

    public function __construct()
    {
        $this->path_image = '/img/tour';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::getAll();
        $path = $this->path_image;

        return view('tour.index', compact('tours', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
    {
        Tour::saveEdit($request, $this->path_image);
        flash('Elemento guardado');
        return redirect('/admin/tour');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour        = Tour::find($id);
        $path        = $this->path_image;
        $tour_image  = TourImages::find($id);
        $image       = ($tour_image != '')? $path.'/'.$id.'/thumb_'.$tour_image->name : '';
        $image_movil = ($tour_image != '')? $path.'/'.$id.'/thumb_'.$tour_image->name_movil : '';

        return view('tour.edit', compact('tour', 'image', 'image_movil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tour::saveEdit($request, $this->path_image, $id);
        flash('Elemento guardado');
        return redirect('/admin/tour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tour::drop($id, $this->path_image);
        flash('Elemento borrado');
        return redirect('/admin/tour');
    }
}
