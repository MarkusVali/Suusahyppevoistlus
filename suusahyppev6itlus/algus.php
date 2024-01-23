<?php
require("conf.php");

// Vahetab alustanud üheks kui vajutad "Alusta" nuppu
if(!empty($_REQUEST["korras_id"])){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE suusahyppajad SET alustanud=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["korras_id"]);
    $kask->execute();
}

// Võtab MySQL'i tabelist neid kellel on "alustanud" -1
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM suusahyppajad WHERE alustanud=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>

<!doctype html>

<html>
<head>
    <title>Suusahüppe</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
    <h1>Suusahüppe koduleht</h1>
</header>
<?php
include("navbar.php")
?>
<h1>Alustamata</h1>
<table>
    <?php
    // Näitab ees- ja perekonnanime senikaua kui vajutad nuppu "Alusta"
    while($kask->fetch()){
        echo " 
        <tr> 
        <td>$eesnimi</td> 
        <td>$perekonnanimi</td> 
        <td> 
        <a href='?korras_id=$id'>Alusta</a>
        </td> 
        </tr> 
        ";
    }
    ?>
</table>
</body>
</html>