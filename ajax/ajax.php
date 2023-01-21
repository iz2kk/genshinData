<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/function.php';

if(isset($_POST["data"])){
    echo  AddMaterial($_POST["data"]);
    return;

}
if(isset($_POST["labelMap"]) && isset($_POST["method"])){

    echo  AddLabels($_POST["labelMap"], $_POST["method"]);
    return;

}   

if(isset($_POST["item_maps"]) && isset($_POST["method"])){

    echo  AddItems($_POST["item_maps"], $_POST["method"]);
    return;

}   












