<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/function.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/imgur/imgur.php';

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

if(isset($_GET["item_id"])){

    $data =  FetchMaterial($_GET["item_id"]);
    if($data == false){
        return;
    }
    $json = stripslashes(json_encode($data, JSON_UNESCAPED_UNICODE));
    echo $json;
    return;

}   


if(isset($_POST["update_material"])){
    echo  UpdateMaterial($_POST["update_material"]);
    return;

}  
if(isset($_FILES["image"])){
    echo  UploadImgur($_FILES["image"]);
    return;

}  








