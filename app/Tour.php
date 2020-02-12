<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tour extends Model
{
    protected $fillable  = ['name', 'description', 'price', 'slug'];

    public static function getAll()
    {
        $tour = Tour::select('tours.id','tours.name', 'description', 'price', 'slug', 'tour_images.name as image')
                        ->join('tour_images', 'tour_images.tour_id', '=' , 'tours.id')
                        ->get();
        return $tour;
    }

    public static function getBySlug($slug)
    {
        $tour = Tour::select('tours.id','tours.name', 'description', 'price', 'slug', 'tour_images.name as image')
            ->join('tour_images', 'tour_images.tour_id', '=' , 'tours.id')
            ->where('slug', $slug)
            ->get();
        return $tour;
    }

    public static function getTags($tours)
    {
        $lbl = '';
        foreach ($tours as $tour){
            $lbl .=  '<a href="/tour/'. $tour->slug.'" class="text-dark">'. $tour->name.' / </a> ';
        }
        $lbl = trim($lbl, '/');
        return $lbl;
    }

    public static function saveEdit($request, $path, $id = null)
    {
        if($id == null){
            $tour = new Tour($request->except('_token', 'image', 'name_movil'));
            $tour->slug = Str::slug($request->name);
            $tour->save();
        }else{
            $tour = Tour::find($id);
            $tour->fill($request->except('_token', 'image', 'name_movil'));
            $tour->slug = Str::slug($request->name);
            $tour->update();
        }

        if ($request->hasFile('image') != false) {

            $path = '.'.$path.'/'. $tour->id;
            if ($id != null) {
                $image = TourImages::find($tour->id);
                @unlink($path .'/'.$image->name);
                @unlink($path . '/thumb_' . $image->name);


            }



            $image_cover            = $request->file('image');
            $new_image              = uploadImage($_FILES['image'], $image_cover, $path, true);
            $set_img                = new TourImages();

            $image_movil_cover      = $request->file('name_movil');
            $new_image_movil        = uploadImage($_FILES['name_movil'], $image_movil_cover, $path, true);

            $set_img                = new TourImages();
            $set_img->tour_id       = $tour->id;
            $set_img->name          = $new_image;
            $set_img->name_movil    = $new_image_movil;
            $set_img->save();
        }

        if ($request->hasFile('name_movil') != false) {

            $path = '.'.$path.'/'. $tour->id;
            if ($id != null) {
                $image = TourImages::find($tour->id);
                @unlink($path .'/'.$image->name_movil);
                @unlink($path . '/thumb_' . $image->name_movil);
            }

            $image_cover      = $request->file('name_movil');
            $new_image        = uploadImage($_FILES['name_movil'], $image_cover, $path, true);
            $set_img          = TourImages::find($tour->id);
            $set_img->name_movil    = $new_image;
            $set_img->update();
        }

    }

    public static function drop($tour_id, $path)
    {
        $tour = Tour::find($tour_id);
        $path = '.'.$path.'/'. $tour->id;

        $image = TourImages::find($tour_id);
        @unlink($path.'/'.$image->name);
        @unlink($path. '/thumb_'.$image->name);

        $tour->delete();
        $image->delete();
    }
}
