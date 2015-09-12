<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapSize extends Model
{
    //
    protected $table = 'mapproductsize';

    public static function mapSize($size_id, $product_id){
    	$obj = new MapSize;
    	$obj->product_id = $product_id;
    	$obj->size_id=$size_id;
    	$obj->save();
    }

    public static function getSize($id){
    	return MapSize::where('product_id',$id)->get();
    }
}
