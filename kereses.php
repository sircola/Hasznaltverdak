<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
    $ab=new mysqli("localhost","hv","titok","hasznaltverdak");
    $ab->set_charset("utf8");
    
    $kereso=htmlspecialchars($_GET["kereso"]);
    
    $er=$ab->query("SELECT aid FROM autok WHERE tipus LIKE '%" . $kereso . "%' LIMIT 1;");    
    
    $honnan = 0;
    $sor = $er->fetch_row();
    if( $sor ) 
        $honnan = $sor[0]-1;
    
    $ab->close();
    
    echo "<script type='text/javascript'>window.location.href = 'index.php?honnan=".$honnan."';</script>";
?>
</body>
</html>
