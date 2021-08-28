<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="formatumok.css" rel="stylesheet" type="text/css" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="funkciok.js"></script>
</head>
<body>
<div class="container">
    <br>
    <br>
        <form method="get" action="mentesAdatbazis.php">
        <table id="regtable">
            <tr>
                <td colspan="3"><h1>Regisztráció:</h1></td>
            </tr>
            <tr>
                <td class="cim"><b>Lakhely város:</b></td>
                <td><input id="ui1" name="varos" type="text" placeholder="pl. Lakihegy"/></td>
                <td><span id="ue1" class="veres">&nbsp;</span></td>
            </tr>
            <tr>
                <td class="cim"><b>Email cím:</b></td>
                <td><input id="ui5" name="email" type="text" /></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="cim"><b>Jelszó 1:</b></td>
                <td><input id="ui3" name="jelszo" type="password" /></td>
                <td>&nbsp;</td>
            </tr>  
            <tr>
                <td class="cim"><b>Jelszó 2:</b></td>
                <td><input id="ui4" type="password" /></td>
                <td>&nbsp;</td>
            </tr>  
            <tr>
                <!--<td id="gomb" colspan="3"><input type="submit" value="Regisztrálok" onclick="Ellenorzes();" /></td>--> 
                <!--<td id="gomb" colspan="3"><button onclick="Ellenorzes();">Regisztrálok</button></td>-->
                <td id="gomb" colspan="3"><input type="button" value="Regisztrálok" onclick="regEllenorzes();" /></td>
            </tr>            
        </table>
        </form>
    <?php
    // put your code here
    ?>
</div>
</body>
</html>
