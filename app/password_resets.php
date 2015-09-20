<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PHPMailer;

class password_resets extends Model
{
    //
    protected $table = 'password_resets';

   public function sendMail($email,$name,$token,$id){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'linhnhungnguyen94@gmail.com';
        $mail->Password = 'nhung1609';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->From = 'noreply@gmail.com';
        $mail->FromName = 'Reset Password';
        $mail->addAddress($email, $name);


        $mail->isHTML(true);
        $mail->Subject = 'Reset Password!';

        //tao noi dung mail
        

        $mail->Body = 'Click <a href="'.asset('/password'). "/" . $token . "/" . $id . '">here resetpassword </a> Or copy link <b> '. Asset('/password') . "/" . $token . "/"  . $id .'</b> to URL Browser. </br> ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if($mail->send()){
            return true;
        }else{
            return false;
        }
    }

}
