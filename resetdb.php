<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
    $ab=new mysqli("localhost","phpmyadmin","bernie");
    $ab->set_charset("utf8");
    $sqlfile=fopen("hasznaltverdak.sql","r");
    $utasitas="";
    while(!feof($sqlfile)){
        $sor=fgets($sqlfile);
        $sor=trim($sor);
        $poz=strpos($sor,"*");
        if($poz>1 && substr($sor,$poz-1,1) == ".")
            $poz = false;
        if($poz===false){
            $utasitas.=$sor;
            if(substr($sor, -1)==";"){
                 $ab->query($utasitas);
                $utasitas="";
            }
        }
    }
    $ab->close();
    
    session_start();
    $_SESSION = array();
    session_destroy();
    echo "<script type='text/javascript'>window.location.href = 'index.php';</script>"; 
?>

</body>
</html>
