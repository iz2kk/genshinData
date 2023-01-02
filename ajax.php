<?php
require_once './config.php';

require_once './function.php';


    if(!isset($_POST["data"]))
        return;


   echo  AddMaterial($_POST["data"]);























