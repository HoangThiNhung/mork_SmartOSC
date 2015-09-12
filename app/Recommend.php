<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    //
    protected $table = 'recommend';


    public static function tokenize($string) {

        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9 ]/', '', $string);

        $count = preg_match_all('/\w+/', $string, $matches);

        return $count ? $matches[0] : array();

    }
}
