<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapColor extends Model
{
    //
    protected $table = 'mapproductcolor';

    public static function mapColor($color_id, $product_id){
    	$obj = new MapColor;
    	$obj->product_id = $product_id;
    	$obj->color_id=$color_id;
    	$obj->save();
    }

    public static function getColor($id){
    	return MapColor::where('product_id',$id)->get();
    }
}
