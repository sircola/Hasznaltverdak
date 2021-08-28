<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Autóim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="formatumok.css" rel="stylesheet" type="text/css" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="funkciok.js"></script>
</head>
<body>
<div class="container">
    
    <br>
    
    <h1 align="center">Járművek törlése:</h1>
    <hr>

<?php

    if(isset($_POST["aid"])){
        
        $aid=$_POST["aid"];
        
        $ab=new mysqli("localhost","hv","titok","hasznaltverdak");
        $ab->set_charset("utf8");
        
        $ab->query("DELETE FROM kepek WHERE aid='$aid';");
        $ab->query("DELETE FROM autok WHERE aid='$aid';");
        
        $ab->close();
        
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit;
    }


    $ab=new mysqli("localhost","hv","titok","hasznaltverdak");
    $ab->set_charset("utf8");
    
    $uid = $_SESSION["uid"];
    
    $cnt=0;
    $er=$ab->query("SELECT autok.aid, autok.tipus, kepek.kep FROM autok LEFT JOIN kepek ON autok.aid = kepek.aid WHERE autok.uid = '$uid';");
    while($sor=$er->fetch_row()){
          
        echo '<form method="POST">' .
             '<table id="uploadtable">'.
            '<tr>'.
            '<td><h1 align="center">' . $sor[1] . '</h1></td>'.
            '<input type="hidden" name="aid" value="' . $sor[0] . '">' .
            '</tr>'.
            '<tr>'.
            '<td>';    
        
        echo "<div align='center'><img class='kep' src='kepek/";
        if($sor[2]) {
            echo $sor[0] . ".jpg' /></div>";
            $kep=fopen("kepek/" . $sor[0] . ".jpg","w");
            fwrite($kep, $sor[2]);
            fclose($kep);
        }
        else 
            echo "nopic.jpg' /></div>";

        echo '<td>'.
             '</tr>' .
             '<tr>' .
             '<td id="gomb"><input type="button" value="Törlés" onclick="askTorles('.
             $cnt .
             ');" /></td>'.
             '</tr>'.
             '</table>'.
             '</form>'.
             '</br>';
        
        $cnt = $cnt + 1;
    }

    $ab->close();
    
    if($cnt<1) {
        echo '</br>'.
             "<h1 align='center'>Nincs feltöltött járműve!</h1>".
             '<div style="text-align:center;height:60px">' .
             '<input type="button" onclick="location.href=' . 
             "'index.php'" .
             ';" value="Vissza" />'.
             '</div>';
    }
?>
</div>
</body>
</html>
