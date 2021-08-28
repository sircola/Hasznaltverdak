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
    <title>Feltöltés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="formatumok.css" rel="stylesheet" type="text/css" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="funkciok.js"></script>
</head>
<body>
<div class="container">
    
    <?php
    if(isset($_POST["tipus"])){
        
        $ab=new mysqli("localhost","hv","titok","hasznaltverdak");
        $ab->set_charset("utf8");
        
        $tipus = htmlspecialchars($_POST["tipus"]);
        $szin = $_POST["szin"];
        $evjarat = $_POST["evjarat"];
        $muszaki = $_POST["muszaki"];
        $kilometer = $_POST["kilometer"];
        $ar = $_POST["ar"];
        $uid = $_SESSION["uid"];
         
        $ab->query("INSERT INTO autok(tipus,szin,evjarat,muszaki,kilometer,ar,statusz,uid) ".
                   "VALUES('$tipus','$szin','$evjarat','$muszaki','$kilometer','$ar',1,'$uid');");
        
        $aid = $ab->insert_id;
      
        $kep=addslashes(file_get_contents($_FILES["kep1"]["tmp_name"])); 
        $ab->query("INSERT INTO kepek(kep,aid) VALUES('$kep','$aid');");
        
        $ab->close();
        
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
        exit;
    }
    ?>

    <br>
    <br>
    
    <form method="post" enctype="multipart/form-data">
    <table id="uploadtable">
        <tr>
            <td colspan="3"><h1>Jármű feltöltése:</h1></td>
        </tr>
        <tr>
            <td class="cim"><b>Kép 1.:</b></td>
            <td><input type="file" id="ui1" name="kep1" /></td>
            <td><span id="ue1" class="veres">&nbsp;</span></td>
        </tr>
        <tr>
            <td class="cim"><b>Kép 2.:</b></td>
            <td><input type="file" id="ui2" name="kep2" /></td>
            <td><span id="ue2" class="veres">&nbsp;</span></td>
        </tr>
        <tr>
            <td class="cim"><b>Kép 3.:</b></td>
            <td><input type="file" id="ui3" name="kep3" /></td>
            <td><span id="ue3" class="veres">&nbsp;</span></td>
        </tr>
        <tr>
            <td class="cim"><b>Típus:</b></td>
            <td><input id="ui4" name="tipus" type="text" placeholder="pl. Trabant 601"/></td>
            <td><span id="ue4" class="veres">&nbsp;</span></td>
        </tr>
        <tr>
            <td class="cim"><b>Szín:</b></td>
            <td><input id="ui5" name="szin" type="text" placeholder="pl. Zöld"/></td>
            <td><span id="ue5" class="veres">&nbsp;</span></td>
        </tr>      
        <tr>
            <td class="cim"><b>Évjárat:</b></td>
            <td><input id="ui6" name="evjarat" type="text" placeholder="pl. 1984"/></td>
            <td><span id="ue6" class="veres">&nbsp;</span></td>
        </tr> 
        <tr>
            <td class="cim"><b>Műszaki:</b></td>
            <td><input id="ui7" name="muszaki" type="text" placeholder="pl. 2024"/></td>
            <td><span id="ue7" class="veres">&nbsp;</span></td>
        </tr> 
        <tr>
            <td class="cim"><b>Kilométer:</b></td>
            <td><input id="ui8" name="kilometer" type="text" placeholder="pl. 10000"/></td>
            <td><span id="ue8" class="veres">&nbsp;</span></td>
        </tr> 
        <tr>
            <td class="cim"><b>Ár:</b></td>
            <td><input id="ui9" name="ar" type="text" placeholder="pl. 150000"/></td>
            <td><span id="ue9" class="veres">&nbsp;</span></td>
        </tr> 
        <tr>
            <td id="gomb" colspan="3"><input type="button" value="Feltöltés" onclick="jarmuEllenorzes();" /></td>
        </tr>            
    </table>
    </form>

</div>
</body>
</html>
