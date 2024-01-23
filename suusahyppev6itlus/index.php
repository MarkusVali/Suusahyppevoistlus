<?php
global $yhendus;
require("conf.php");

// Sisestab ees- ja perekonnanimi andmebaasi.
if(isSet($_REQUEST["sisestusnupp"])){
    $kask=$yhendus->prepare(
        "INSERT INTO suusahyppajad(eesnimi, perekonnanimi) VALUES (?, ?)"); $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]); $kask->execute();
    $yhendus->close();
    header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]"); exit();
}

// Kasutaja ja tema andmete kustutamine
if(isset($_REQUEST["kustuta"])){
    $paring=$yhendus->prepare("DELETE FROM suusahyppajad WHERE id=?");
    $paring->bind_param("i", $_REQUEST["kustuta"]);
    $paring->execute();
}
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
<body>
<h1>Registreerimine</h1>
<?php
// Näitab kui on keegi lisatud eesnimega
if(isSet($_REQUEST["lisatudeesnimi"])){
    echo "Lisati $_REQUEST[lisatudeesnimi]";
}
?>
<form action="?">
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" required/></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" required/></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
    </dl>
</form>

<ul>
    <?php
    global $yhendus;
    // Andmebaasi tabeli kuvamiseks MySQL andmebaasist
    $paring=$yhendus->prepare("SELECT eesnimi, perekonnanimi, kaugus, id FROM suusahyppajad ORDER BY eesnimi");
    $paring->bind_result($eesnimi, $eesnimi, $perekonnanimi, $id);
    $paring->execute();
    while($paring->fetch()){
        echo "<li><a href='?Suusataja_id=$id'>$eesnimi</a></li>";
    }
    ?>
</ul>

<div id="sisu">
    <table>
        <?php
        require("conf.php");
        global $yhendus;
        // Andmebaasi tabeli kuvamiseks MySQL andmebaasist
        if(isset($_REQUEST["Suusataja_id"])){
            $paring=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi, alustanud, lopetanud, kaugus FROM suusahyppajad WHERE id=?");
            $paring->bind_result($id, $eesnimi, $perekonnanimi, $alustanud, $lopetanud, $kaugus);
            $paring->bind_param("i", $_REQUEST["Suusataja_id"]);
            $paring->execute();


            // näitame ühe kaupa
            if($paring->fetch()){
                echo "<h2>Eesnimi: $eesnimi</h2>";
                echo "<h2>Perekonnanimi: $perekonnanimi</h2>";
                // Kui on lõpetanud näitab teksti "Lõpetanud" tema andmete all
                if ($lopetanud == 1) {
                    echo "<h2>Lõpetanud</h2>";
                }
                // Kui ei ole alustanud näitab teksti "Pole alustanud!" tema andmete all
                elseif ($alustanud == -1) {
                    echo "<h2>Pole alustanud!</h2>";
                }
                // Kui ei ole lõpetanud näitab teksti "Pole lõpetanud!" tema andmete all
                elseif ($lopetanud == -1 and $alustanud == 1) {
                    echo "<h2>Pole lõpetanud!</h2>";
                }
                // Kui kaugus võrdub nulliga, siis näitab teksti "Pole kaugust!"
                if ($kaugus == 0) {
                    echo "<h2>Pole kaugust!</h2>";
                }
                // Kui kaugus on kõrgem kui null, siis näitab teksti "Kaugus: [number] meetrit"
                elseif ($kaugus > 0) {
                    echo "<h2>Kaugus: $kaugus meetrit</h2>";
                }
                echo "<a href='?kustuta=$id' ? class='Kustuta'>Kustuta</a>";
            }
        }

        ?>
    </table>
</div>

</body>
</html>