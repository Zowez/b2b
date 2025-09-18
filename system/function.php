<?php
require_once 'config.php';

function compress($buffer)
{
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t"), '', $buffer);
    return $buffer;
}
function alert($message, $alert)
{   
    if($alert == "success") 
        echo '<div style="color: green; ">' . $message . '</div>';
    if($alert == "warning")
        echo '<div style="color: orange; ">' . $message . '</div>';
    if($alert == "danger")
        echo '<div style="color: red; ">' . $message . '</div>';
}

function dt($par,$status = false){
    if($status == false){
        return date('d.m.Y',strtotime($par));
    }else{
        return date('H:i',strtotime($par));
    }
}

function post($par)
{
    return strip_tags(trim($_POST[$par]));
}

function get($par, $default = null)
{
    return isset($_GET[$par]) ? strip_tags(trim($_GET[$par])) : $default;
}


function mobilecontrol()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|iemobile|ip(hone|od)|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)|iris|mini|mobi|palm|symbian|vodafone|wap|windows (ce|phone)|xda|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function go($url, $time = false)
{

    if ($time == false) {
        return header('Location:' . $url);
    } else {
        // return header('refresh:'.$time.':url='.$url);
        return header('refresh:' . $time . ';url=' . $url);
    }
}


function loc()
{

    $loc =  "http://localhost" . $_SERVER['REQUEST_URI'];
    return $loc;
}


function IP()
{

    if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            $ip = trim($tmp[0]);
        }
    } else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}
