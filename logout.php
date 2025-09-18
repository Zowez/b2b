<?php 

    require_once 'system/function.php';

    $log = $db->prepare("INSERT INTO seller_logs SET
        seller     =:s,
        ip       =:i,
        description =:d
    ");
    $log->execute([
        ':s'   => $seller_code,
        ':i'   => IP(),
        ':d'   => "Çıkış yapıldı"
    ]);

    session_destroy();
    header('Location:'.site);

?>