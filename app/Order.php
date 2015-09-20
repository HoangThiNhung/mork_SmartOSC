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

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'address', 'total'];

    public static function addOrder($checkout,$data){
        $order = new Order;
        $order->name = $checkout['name'];
        $order->email = $checkout['email'];
        $order->phone = $checkout['phone'];
        $order->address = $checkout['address'];
        $order->total = $checkout['total'];
        $order->active_order = md5(time());
        $order->save();

        $order->sendMail($checkout,$data,$order->active_order,$order->id);
        return $order->id;
    }

    public function sendMail($checkout,$data,$token,$id){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'linhnhungnguyen94@gmail.com';
        $mail->Password = 'nhung1609';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = 'noreply@gmail.com';
        $mail->FromName = 'Oreju';
        $mail->addAddress($checkout['email'], $checkout['name']);


        $mail->isHTML(true);
        $mail->Subject = 'Confirm Order!';

        //tao noi dung mail
        
        $mail->Body = '
        
        Chào '.$checkout['name'].' ! <br>
        Cám ơn bạn đã quan tâm tới cửa hàng chúng tôi. Xin vui lòng kiểm tra lại thông tin cá nhân bên dưới<br>
        <section class="content">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h2 class="box-title">Order Detail</h2>
                </div><!-- /.box-header -->
                <!-- form start -->
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                <tr>
                                    <td>ID Order :</td>
                                    <td>'.$id.'</td>
                                </tr>
                                <tr>
                                    <td>Name :</td>
                                    <td>'.$checkout['name'].'</td>
                                </tr>
                                <tr>
                                    <td>Email :</td>
                                    <td>'.$checkout['email'].'</td>
                                </tr>
                                <tr>
                                    <td> Phone :</td>
                                    <td>'.$checkout['phone'].'</td>
                                </tr>
                                <tr>
                                    <td>Address :</td>
                                    <td>'.$checkout['address'].'</td>
                                </tr>

                            </table>

                            
                    </div><!-- /.box-body -->
              </div>
          </section> <br> 
          Và Click vào <a href="'.asset('/confirm-order'). "/" . $token . "/" . $id . '">Đây </a> để xác nhận đơn hàng. Hoặc copy link <b> '. Asset('/confirm-order') . "/" . $token . "/"  . $id .'</b> vào trình duyệt. </br> Cám ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi   ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if($mail->send()){
            return true;
        }else{
            return false;
        }
    }

    public static  function checkactive($token,$id){
        $a;
        $result = Order::where('id',$id)->where('active_order',$token)->first();
        if($result!=""){
            if($result->status == '0'){
                Order::where('id',$id)->update(array('status'=>'1'));
                $a=2;
            }else{
                $a=1;
            }
        }else{
            $a=0;
        }

        return $a;
    }

}