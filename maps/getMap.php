<?php 
include_once './Maps.php';

    if(isset($_GET["teyvat"])){
        $teyvat = Teyvat();
        echo $teyvat;
        return;
    }

    if(isset($_GET["enka"])){
        $enka = Enka();
        echo $enka;
        return;
    }

    if(isset($_GET["under"])){
        $Underground = UndergroundMines();
        echo $Underground;
        return;
    }
?>

