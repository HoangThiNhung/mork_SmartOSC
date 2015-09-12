<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Validator;
use Request;
use DB;
use Input;
use PHPMailer;

class newsComment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'newscomment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public static function addreview($id,$data){
        $review                 = new newsComment();
        $review->name           = $data['name'];
        $review->email          = $data['email'];
        $review->content        = $data['content'];
        $review->news_id     =$id;

        $review->save();
        return;

    }


    public static function getCount($idnews){
        return newsComment::where('news_id',$idnews)->count('id');
    }

    public static function getreview($idnews){
        return newsComment::where('news_id',$idnews)->orderby('id' , 'desc')->get();

    }
}