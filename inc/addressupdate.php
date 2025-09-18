<?php 

require_once '../system/function.php';

if (@$_SESSION['login'] != @sha1(md5(IP() . $seller_code))) {
    go(site);
}

if($_POST){
    
    $title      = post('title');
    $directions    = post('directions');
    $status     = post('status');
    $addressid  = post('addressid');

   

    if(!$title || !$directions || !$status || !$addressid){

        echo 'empty';

    }else{
       
       
        $result = $db->prepare("UPDATE seller_addresses SET
            
            title=:t,
            directions =:d,
            status =:s WHERE seller=:code AND id=:id

        ");

        $result->execute([
            ':s'     => $status,
            ':t'     => $title,
            ':d'     => $directions,
            ':code'  => $seller_code,
            ':id'    => $addressid
        ]);

        if($result){

            $log = $db->prepare("INSERT INTO seller_logs SET
                seller     =:s,
                ip       =:i,
                descriptions =:d
            ");
            $log->execute([
                ':s'   => $seller_code,
                ':i'   => IP(),
                ':d'   => "Adres güncellemesi yaptı"
            ]);

            echo 'ok';
        }else{
            echo 'error';
        }

        
    }

}

?>