<?php 

require_once '../system/function.php';

if (@$_SESSION['login'] != @sha1(md5(IP() . $seller_code))) {
    go(site);
}

if($_POST){

    $title      = post('title');
    $directions    = post('directions');
   

    if(!$title || !$directions ){

        echo 'empty';

    }else{
       
       
        $result = $db->prepare("INSERT INTO seller_addresses SET  
            title=:t,
            directions=:d,
            seller=:s,
            status=:st
        ");

        $result->execute([
            ':t'     => $title,
            ':d'     => $directions,
            ':s'     => $seller_code,
            ':st'    => 1
        ]);

        if($result->rowCount()){

            $log = $db->prepare("INSERT INTO seller_logs SET
                seller     =:s,
                ip       =:i,
                descriptions =:d
            ");
            $log->execute([
                ':s'   => $seller_code,
                ':i'   => IP(),
                ':d'   => "Yeni adres eklemesi yaptı"
            ]);

            echo 'ok';
        }else{
            echo 'error';
        }

        
    }

}

?>