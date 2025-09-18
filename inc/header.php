<?php require_once 'system/function.php'; 

if($row['status'] == 0){
  go(site.'maintenance.php');
}

print_r( @$_SESSION);
print_r( $site);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500">
    <link rel="stylesheet" href="styles/style.css">
    
    <script src="scripts/uikit.js"></script>
    <script src="scripts/uikit-icons.js"></script>


</head>

<body>