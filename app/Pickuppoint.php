<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickuppoint extends Model
{
    protected $table = 'pickUpPoints';
    protected $fillable = ['name'];

    public static function saveEdit($request,  $id = null)
    {
        if($id == null){
            $point = new Pickuppoint($request->except('_token'));
            $point->save();
        }else{
            $point = Pickuppoint::find($id);
            $point->fill($request->except('_token'));
            $point->update();
        }
    }
}
