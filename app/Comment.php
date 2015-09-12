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

class Comment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'content', 'product_id', 'rating'];

    public static function addreview($id,$data){
        $review                 = new Comment();
        $review->name           = $data['name'];
        $review->email          = $data['email'];
        $review->content        = $data['content'];
        $review->rating        = $data['rating'];
        $review->product_id     =$id;

        $review->save();
        return;

    }

    public static function getAvg($idproduct){
        return Comment::where('product_id',$idproduct)->avg('rating');
    }

    public static function getCount($idproduct){
        return Comment::where('product_id',$idproduct)->count('id');
    }

    public static function getreviewProduct($idproduct){
        return Comment::where('product_id',$idproduct)->orderby('id' , 'desc')->get();

    }
}