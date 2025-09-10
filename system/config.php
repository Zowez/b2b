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