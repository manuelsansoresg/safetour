<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourImages extends Model
{
    protected $primaryKey = 'tour_id';

    public static function getAll()
    {
        $images = TourImages::all();
        return $images;
    }
}
