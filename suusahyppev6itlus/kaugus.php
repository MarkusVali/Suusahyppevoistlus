<?php
require("conf.php");

// Teeb lõpetanud üheks ja kauguse input'iks kui nuppu vajutad
if(!empty($_REQUEST["submit"])){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE suusahyppajad SET lopetanud=1, kaugus=? where id=?"
    );
    $kask->bind_param("ii", $_REQUEST["kasMaandunud"], $_REQUEST["id"]); $kask->execute();
}

// Võtab MySQL'i listi nendest kes on alustanud, aga pole lõpetanud
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi FROM suusahyppajad WHERE alustanud=1 AND lopetanud=-1");
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
// Lisab navbar'i
include("navbar.php")
?>
<h1>Kauguse sisestamine</h1>
<table>
    <?php
    // Andmebaasi tabeli kuvamiseks MySQL andmebaasist ja sellele lisamiseks, kus kaugus on vajalik ja miinimum kaugus meetrites on 1
    while($kask->fetch()){
        echo " 
        <tr> 
        <td>$eesnimi</td> 
        <td>$perekonnanimi</td> 
        <td><form action=''> 
        <input type='hidden' name='id' value='$id' /> 
        <input type='number' name='kasMaandunud' placeholder='Kaugus (meetrites)' min=1 required/>
        <input type='submit' value='Sisesta' name='submit' /> 
        </form> 
        </td> 
        </tr> 
        ";
    }
    ?>

</table>
</body>
</html>

