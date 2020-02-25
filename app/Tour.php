<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Verot\Upload\Upload;

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

        $old_path = $path.'/'. $tour->id;
        $path = '.'.$path.'/'. $tour->id;

        if ($request->hasFile('image') != false) {

            @mkdir($path);

            if ($id != null) {
                $image = TourImages::find($tour->id);
                @unlink($path .'/'.$image->name);
                @unlink($path . '/thumb_' . $image->name);


            }



            $image_cover            = $request->file('image');
            $new_image              = self::uploadImage($request, 'image', $old_path);



            $set_img                = new TourImages();

            $image_movil_cover      = $request->file('name_movil');
            //$new_image_movil        = uploadImage($_FILES['name_movil'], $image_movil_cover, $path, true);
           //$new_image_movil        = self::uploadImage($request, 'name_movil', $old_path);


            //move_uploaded_file($_FILES['name_movil']['tmp_name'], $path);

            $set_img                = new TourImages();
            $set_img->tour_id       = $tour->id;
            $set_img->name          = $new_image;
           /* $set_img->name_movil    = $new_image_movil;*/
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
            //$new_image        = uploadImage($_FILES['name_movil'], $image_cover, $path, true);
            $new_image        = self::uploadImage($request, 'name_movil', $old_path);
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

    public static function uploadImage($request, $name, $path)
    {
        if($request->hasFile($name) != false){ //image is not empty portada
            $image_cover = $request->file($name);
            /**
             * crear nombres para las imagenes
             */

            $fullName =$image_cover->getClientOriginalName();
            $extension =$image_cover->getClientOriginalExtension();
            $onlyName = explode('.'.$extension,$fullName)[0];


            $name_thumb = 'thumb_'.time().'.'.$onlyName;
            $name_full_thumb = 'thumb_'.time().'.'.$fullName;

            /**
             * seccion para redimencionar imagen
             */
            $name_cover =  Str::slug($onlyName).'.'.$extension;
            $name_upload = Str::slug($onlyName);

            $thumb = new upload($_FILES[$name]);
            if ($thumb->uploaded) {
                $thumb->file_new_name_body   = $name_upload;
                $thumb->file_name_body_pre = 'thumb_';
                $thumb->image_resize         = true;
                $thumb->image_x              = 300;
                $thumb->process('.'.$path.'/');
            }


            $image_cover->move('.'.$path, $name_cover);

            return $name_cover;
        }
    }
}
