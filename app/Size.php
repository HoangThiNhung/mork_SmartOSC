<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //
    protected $table = 'size';

    protected $fillable = ['name'];

    public static function addSize($size){
    	$data = new Size;
    	$data->name = $size;
    	$data->save();
    	return $data->id;
    }

}
