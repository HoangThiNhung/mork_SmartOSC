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

class Product extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','SKU', 'image', 'price', 'promotion', 'quantity', 'color', 'size', 'category_id', 'description','status'];   
    
    public static function addProduct($data){
      $obj = new Product;
      $obj->name = $data['name'];
      $obj->SKU = $data['SKU'];
      $obj->price = $data['price'];
      $obj->category_id = $data['category_id'];
      $obj->quantity= $data['quantity'];
      $obj->status = $data['status'];
      $obj->image = $data['image'];
      $obj->promotion= $data['promotion'];
      $obj->description = $data['description'];
      $obj->save();
      return $obj->id;
    }

     /**
     * getAll users
     *
     * @var 
     */

    public function getAll(){
        // $this->where()
       return DB::table('product')->paginate(5)->setpath('product');
    }

    public function getHotPro(){
        return DB::table('product')
                    ->whereIn('category_id', ['3', '4','5'])
                    ->orderBy('id','desc')
                    ->take(10)
                    ->get();
    }

    public function getHotman(){
        return DB::table('product')
                    ->whereIn('category_id', ['6', '7'])
                    ->orderBy('id','desc')
                    ->take(10)
                    ->get();
    }

    public static function getproductcate($cateid,$id=""){
        return Product::where('category_id',$cateid)
                        ->whereNotIn('id',array($id))->paginate(9)->setpath($id);
    }

 

    public function updateProduct($id){
        $data = Request::all();
        return DB::update('update `product` 
            set `name` = :name,
                `price` = :price,
                `promotion` = :promotion,
                `quantity` = :quantity,
                `color` =:color,
                `size` =:size,
                `category_id` =:category_id,
                `status` =:status
            where id = :id',    ['name'=>$data['name'],
                                'price'=>$data['price'],
                                'promotion'=>$data['promotion'],
                                'quantity'=>$data['quantity'],
                                'color'=>$data['color'],
                                'size'=>$data['size'],
                                'category_id'=>$data['category_id'],
                                'status'=>$data['status'],
                                'id'=>$id
            ]);
    }

    public function getRelative($catid,$id){
        return DB::table('product')
                    ->where('category_id',$catid)
                    ->groupBy('id')
                    ->having('id','<>',$id)
                    ->take(5)
                    ->get();
    }

    public static function search($key){
        return Product::where(
            'name' ,'like','%'.$key.'%')->orwhere(
            'price' ,'like','%'.$key.'%')->paginate(12)->setpath('search');
    }

    public static function getCookie($cookie){
      return Product::where('id',$cookie)->get();
    }

    public function getRecommend($groups){
      return DB::table('product')
                ->where('status',$groups)
                ->get();
    }



   public static function convert_vi_to_en($str, $flag = true) {
   $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
   $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
   $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
   $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
   $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
   $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
   $str = preg_replace("/(đ)/", 'd', $str);
   $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
   $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
   $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
   $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
   $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
   $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
   $str = preg_replace("/(Đ)/", 'D', $str);
   //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
    
   return ($flag) ? str_slug($str, '-') : $str;
  }
}
