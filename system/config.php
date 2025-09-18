<?php 

session_start();
ob_start('compress');
date_default_timezone_set('Europe/Istanbul');


try{

    $db = new PDO("mysql:host=localhost;dbname=b2b;charset=utf8;","root","");
    $db->query("SET CHARACTER SET utf8");
    $db->query("SET NAMES utf8");

}catch(PDOException $e){
    print_r($e->getMessage());
    die();
}

$query = $db->prepare("SELECT * FROM settings LIMIT :lim");
$query->bindValue(":lim",(int)1,PDO::PARAM_INT);
$query->execute();
if($query->rowCount()){
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $site = $row['url'];

    if($row['status'] != 1){
        if (basename($_SERVER['PHP_SELF']) != "maintenance.php") {
            go($site.'maintenance.php');
            exit;
        }
    }

}

define("site",$site);
define("title",$row['title']);

# Login Check

if(  @$_SESSION['login'] == @sha1(md5(IP().$_SESSION['code'])) ){
    $logincontrol = $db->prepare("SELECT * FROM sellers WHERE id=:id AND code=:c");
    $logincontrol->execute([':id'=> @$_SESSION['id'],':c'=> @$_SESSION['code']]);
    if($logincontrol->rowCount()){
        $par = $logincontrol->fetch(PDO::FETCH_ASSOC);

        if( $par['status'] == 1 ){
            $seller_id = $par['id'];
            $seller_code = $par['code'];
            $seller_name = $par['name'];
            $seller_date = $par['date'];
            $seller_logo = $par['logo'];
            $seller_email = $par['email'];
            $seller_discount = $par['discount'];
            $seller_phone = $par['phone'];
            $seller_tax_number = $par['tax_number'];
            $seller_tax_office = $par['tax_office'];
            $seller_fax = $par['fax'];
            $seller_site = $par['site'];
            $seller_status = $par['status'];
        }else{
            @session_destroy();
            go(site);
        }

        

    }else{
        @session_destroy();
    }

}


?>