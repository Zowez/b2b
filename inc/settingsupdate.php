<?php 

require_once '../system/function.php';

if(@$_SESSION['login'] != @sha1(md5(IP().$seller_code))){
    echo 'error';
    exit;
}

if($_POST){

    $seller_email = post('email');
    $current_password = post('current_password'); 
    $seller_password = post('password');       
    $seller_confirm_password = post('confirm_password');

    if(!$seller_email && !$seller_password && !$seller_confirm_password){
        echo 'empty';
        exit;
    }

    if($seller_email){
        if(!filter_var($seller_email,FILTER_VALIDATE_EMAIL)){
            echo 'format';
            exit;
        }

        $already = $db->prepare("SELECT email FROM sellers WHERE email=:email AND code!=:code");
        $already->execute([
            ':email' => $seller_email,
            ':code'  => $seller_code
        ]);

        if($already->rowCount()){
            echo 'already';
            exit;
        }

        $updateEmail = $db->prepare("UPDATE sellers SET email=:email WHERE code=:code");
        $updateEmail->execute([
            ':email' => $seller_email,
            ':code'  => $seller_code
        ]);
    }

    if($seller_password || $seller_confirm_password){

        if(!$current_password){
            echo 'current_empty';
            exit;
        }

        $cryptoCurrent = sha1(md5($current_password));
        $check = $db->prepare("SELECT password FROM sellers WHERE code=:code AND password=:password");
        $check->execute([
            ':code' => $seller_code,
            ':password' => $cryptoCurrent
        ]);

        if(!$check->rowCount()){
            echo 'current_wrong';
            exit;
        }

        if($seller_password != $seller_confirm_password){
            echo 'password_mismatch';
            exit;
        }

        if(strlen($seller_password) < 6){
            echo 'password_short';
            exit;
        }

        $cryptoNew = sha1(md5($seller_password));
        $updatePass = $db->prepare("UPDATE sellers SET password=:password WHERE code=:code");
        $updatePass->execute([
            ':password' => $cryptoNew,
            ':code'     => $seller_code
        ]);
    }

    echo 'ok';
}
?>
