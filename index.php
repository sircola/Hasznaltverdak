<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Használt Verdák</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="formatumok.css" rel="stylesheet" type="text/css" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="funkciok.js"></script>
</head>

<body>
<div class="container">
    
    <br>
    
    <h1 align="center">HasználtVerdák!</h1>
    <hr>
    
    <form name="kereso" method="get" action="kereses.php">
    <table id="searchtable">
        <td><h4 style="text-align:center;">Keresés:</h4></td>
        <td><input id="kereso" name="kereso" type="text" style="width:99%;" placeholder="pl. Polski Fiat 1.9 TD Convertible"/></td>    
        <td id="gomb"><input type="button" style="width:99%;" class="btn btn-block btn-primary" value="Keresés" onclick="keresesEllenorzes();" /></td>
    </table>
    </form>        
            
    <br>
    <br>  
    
    <?php
        $honnan = 0;
        if(isset($_GET["honnan"]))
            $honnan = intval($_GET["honnan"]);
        
        $ab=new mysqli("localhost","hv","titok","hasznaltverdak");
        $ab->set_charset("utf8");
    
        $er = $ab->query("SELECT COUNT(*) FROM autok;");
        $sor = $er->fetch_row();
        $maxcnt = 0;
        if( $sor ) 
            $maxcnt = $sor[0];
        
        if( $honnan > 0 ) {
            if($honnan > ($maxcnt - 3))
                $honnan = $maxcnt - 3;
            if($honnan<0)
                $honnan=0;
        }
        
        $aids = array($honnan+1,$honnan+2,$honnan+3);
       
        $er=$ab->query("SELECT autok.aid, autok.tipus, autok.szin, kepek.kep, felhasznalok.email, felhasznalok.varos, autok.ar " .
                       "FROM autok LEFT JOIN kepek ON autok.aid = kepek.aid " .
                       "LEFT JOIN felhasznalok ON autok.uid = felhasznalok.uid ORDER BY aid LIMIT 3 OFFSET $honnan;");
        
        echo '<div class="row">';
        
        while($sor=$er->fetch_row()){
        
            echo '<div class="col-md-4 col-sm-12">'.
                 '<div class="card h-100">';
            
            echo "<div align='center'><img class='kep' src='kepek/";
            if($sor[3]) {
                echo $sor[0] . ".jpg' /></div>";
                $kep=fopen("kepek/" . $sor[0] . ".jpg","w");
                fwrite($kep, $sor[3]);
                fclose($kep);
            }
            else
                echo "nopic.jpg' /></div>";

            echo '<div class="card-body">'.
                '<h4 class="card-title">'.
                    $sor[1] .
                        '</h4>'.
                        '<h5>'.
                    $sor[2].
                    '</h5>'.
                        '<p class="card-text">'.
                        $sor[5] .
                    '</p>'.
                    '<h5>'.
                            $sor[6] . " Ft.".
                    '</h5>'.
                    '</div>'.
                    '<div class="card-footer">'.
                        $sor[4].
                    '</div>'.
                '</div>'.
            '</div>';

        }
        echo '</div>';
        
        $ab->close();
    ?>
    
    <br/>
    <table border="0" align="center" width="30%">
        <tr>
            <td style="text-align:right;padding-right:20px" width="40%">
                <input type="button" value="Előző 3 jármű" onclick="Ujra(-3,<?php echo $maxcnt;?>);" />    
            </td>
            <td>
                &nbsp;
            </td>
            <td style="text-align:left;padding-left:20px" width="40%">
                <input type="button" value="Következő 3 jármű" onclick="Ujra(3,<?php echo $maxcnt;?>);" />    
            </td>
        </tr>
    </table>
    
    <br>
    <br>

    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
        echo '<div style="text-align:center;height:60px">' .
             '<input type="button" onclick="location.href=' . 
             "'feltoltes.php'" .
             ';" value="Jármű feltöltése" />'.
             '</div>';
    }
    ?>

    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
        echo '<div style="text-align:center;height:60px">' .
             '<input type="button" onclick="location.href=' . 
             "'autoim.php'" .
             ';" value="Járművek tőrlése" />'.
             '</div>';
    }
    ?>
    
    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true && $_SESSION["uid"] == 1) {
        echo '<div style="text-align:center;height:60px">' .
             '<input type="button" style="color:red;" onclick="location.href=' . 
             "'resetdb.php'" .
             ';" value="!! Admin DB reset !!" />'.
             '</div>';
    }
    ?>
    
    <?php
    if(isset($_POST["kilep"])){
        session_start();
        $_SESSION = array();
        session_destroy();
        $files = glob('kepek/*.jpg');
        foreach($files as $file) 
            if(is_file($file)&&!strpos($file, "nopic.jpg"))
                unlink($file);
        echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    }
   
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true) {
    echo '<form method="post">'.
        '<table border="1" align="center" width="30%">'.
            '<tr>'.
                '<td colspan="2" style="text-align:left;"><h1>Kilépés:</h1></td>'.
            '</tr>'.
            '<tr>'.
                '<td colspan="2" style="text-align:left;">mint <b>'. $_SESSION["email"] .'</b>.</td>'.
            '</tr>'.
            '<tr>'.
                '<td id="gomb" colspan="2">'.
                    '<input name="kilep" type="submit" value="Kilépés" />'.
                '</td>'.
            '</tr>'.
        '</table>'.
    '</form>';
    }
    ?>

    <?php
    if(isset($_POST["elkuld"])&&strlen($_POST["email"])>0&&strlen($_POST["jelszo"])>0){
        
        $ab=new mysqli("localhost","hv","titok","hasznaltverdak");
        $ab->set_charset("utf8");
        
        $email=htmlspecialchars($_POST['email']);
        $er=$ab->query("SELECT jelszo, uid FROM felhasznalok WHERE email='$email';");

        $ok=false;
        $sor=$er->fetch_row();
        if($sor&&$sor[0]==md5($_POST["jelszo"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["uid"] = $sor[1];
            $ok = true;    
        }
        
        $ab->close();
          
        if($ok)
            echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
    }

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo '<form method="post">'.
        '<table border="1" align="center" width="30%">'.
            '<tr>'.
                '<td colspan="2" style="text-align:left;"><h1>Belépés:</h1>vagy <a href="regisztracio.php">regisztráció.</a></td>'.
            '</tr>'.
            '<tr>'.
                '<td class="cim"><b>Email:</b></td>'.
                '<td><input id="ui1" name="email" type="text" placeholder="ko.pal@otthon.hu"/></td>'.
            '</tr>'.
            '<tr>'.
                '<td class="cim"><b>Jelszó:</b></td>'.
                '<td><input id="ui3" name="jelszo" type="password" /></td>'.
            '</tr>'.  
            '<tr>'.
                '<td id="gomb" colspan="2">'.
                    '<input name="elkuld" type="submit" value="Belépés" />'.
                '</td>'.
            '</tr>'.            
        '</table>'.
    '</form>';
    }
    ?>   
    
    <br>
    <br>
    
</div>
</body>
</html>
