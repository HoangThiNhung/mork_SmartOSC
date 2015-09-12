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

class Order_detail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public static function addOrder_detail($orderid,$key){
        $Order_detail = new Order_detail;
        $Order_detail->order_id = $orderid;
        $Order_detail->product_id = $key['id'];
        $Order_detail->quantity = $key['quantity'];
        $Order_detail->color_id =$key['color'];
        $Order_detail->size_id=$key['size'];
        $Order_detail->price = $key['quantity']*$key['price'];
        $Order_detail->save();
        return;
    }
}