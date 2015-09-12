<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'image';

    protected $fillable = ['name'];

    public static function addImage($product_id, $image){
    	$data = new Image;
    	$data->product_id = $product_id;
    	$data->path = $image;
    	$data->save();
    }

    public static function getImage($id){
    	return Image::where('product_id',$id)->get();
    }
}
