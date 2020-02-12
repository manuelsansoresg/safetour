<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePay extends Model
{
    protected $fillable = ['name', 'type', 'price', 'legend'];

    public static function saveEdit($request,  $id = null)
    {
        if($id == null){
            $point = new TypePay($request->except('_token'));
            $point->save();
        }else{
            $point = TypePay::find($id);
            $point->fill($request->except('_token'));
            $point->update();
        }
    }
}
