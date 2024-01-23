<?php
$serverinimi = "d125332.mysql.zonevs.eu";
$kasutajanimi = "d125332_phphaldu";
$parool = "Parikmaherom";
$andmebaas = "d125332_suusahypp";
$yhendus = new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaas);
$yhendus->set_charset("UTF8");