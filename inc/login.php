<?php 
require_once '../system/function.php';

if( @$_SESSION['login'] == @sha1(md5(IP().$_SESSION['code'])) ){
    go(site);
}

if($_POST){


    $email_or_code    = post('email_or_code');
    $password  = post('password');
    $crypto = sha1(md5($password));

    if(!$email_or_code || !$password){
        echo 'empty';
    }else{

        $login = $db->prepare("SELECT * FROM sellers WHERE (code=:c AND password=:p) OR (email=:e AND password=:pp)");

        $login->execute([
            ':c' => $email_or_code,
            ':p' => $crypto,
            ':e' => $email_or_code,
            ':pp'=> $crypto
        ]);

        if($login->rowCount()){

            $par = $login->fetch(PDO::FETCH_OBJ);
            if($par->status == 1){

                $log = $db->prepare("INSERT INTO seller_logs SET
                    seller     =:s,
                    ip       =:i,
                    description =:d
                ");
                $log->execute([
                    ':s'   => $par->code,
                    ':i'   => IP(),
                    ':d'   => "Giriş yapıldı"
                ]);

                $encode = sha1(md5(IP().$par->code));
                $_SESSION['login'] = $encode;
                $_SESSION['id']    = $par->id;
                $_SESSION['code']  = $par->code;

               echo 'ok';

             

            }else{
                echo 'passive';
            }

        }else{
            echo 'error';
        }

    }


}


?>