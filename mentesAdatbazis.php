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
    $utasitas=$ab->prepare("INSERT INTO felhasznalok(varos,jelszo,email) VALUES(?,?,?);");
    $varos=$_GET["varos"];
    $jelszo=md5($_GET["jelszo"]);
    $email=$_GET["email"];
    $utasitas->bind_param("sss",$varos,$jelszo,$email);
    $utasitas->execute(); 
    $ab->close();
    header('Location: index.php');
    ?>
</body>
</html>
