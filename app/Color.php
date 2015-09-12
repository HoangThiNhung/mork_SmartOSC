<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'color';

    protected $fillable = ['name'];

    public static function addColor($color){
    	$data = new Color;
    	$data->name = $color;
    	$data->save();
    	return $data->id;
    }

}
