<?php 

require_once 'system/function.php';

if( @$_SESSION['login'] == @sha1(md5(IP().$seller_code)) ){
    go(site);
}

if($_POST){

    $seller_name  = post('name');
    $seller_mail  = post('mail');
    $seller_password  = post('password');
    $seller_confirm_password = post('confirm_password');
    $seller_phone = post('phone');
    $seller_tax_number = post('tax_number');
    $seller_tax_office = post('tax_office');

    $seller_code  = uniqid();
    $crypto = sha1(md5($seller_password));

    if(!$seller_name || !$seller_mail || !$seller_password || !$seller_confirm_password || !$seller_phone || !$seller_tax_number || !$seller_tax_office){

        echo 'empty';

    }else{
        if(!filter_var($seller_mail,FILTER_VALIDATE_EMAIL)){
            echo 'format';
        }else{

            if($seller_password != $seller_confirm_password){
                echo 'match';
            }else{

                $already = $db->prepare("SELECT mail FROM sellers WHERE mail=:b");
                $already->execute([':b'=> $seller_mail]);
                if($already->rowCount()){
                    echo 'already';
                }else{

                    $result = $db->prepare("INSERT INTO sellers SET
                        code    =:seller_code,
                        name     =:seller_name,
                        mail    =:seller_mail,
                        password =:seller_password,
                        phone    =:seller_phone,
                        tax_number =:seller_tax_number,
                        tax_office =:seller_tax_office

                    ");

                    $result->execute([
                        ':seller_code' => $seller_code,
                        ':seller_name' => $seller_name,
                        ':seller_mail' => $seller_mail,
                        ':seller_password' => $crypto,
                        ':seller_phone' => $seller_phone,
                        ':seller_tax_number' => $seller_tax_number,
                        ':seller_tax_office'   => $seller_tax_office
                    ]);

                    if($result->rowCount()){
                        echo 'ok';
                    }else{
                        echo 'error';
                    }

                }

            }

        }
    }

}

?>