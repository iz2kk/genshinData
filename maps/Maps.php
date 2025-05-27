<?php

//api map teyvat
function Teyvat(){
    $url ="https://sg-public-api-static.hoyolab.com/common/map_user/ys_obc/v1/map/point/list?map_id=2&app_sn=ys_obc&lang=en-us";

    //  Initiate curl
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    return $result;
}

//api map Enka
function Enka(){
    $url ="https://sg-public-api-static.hoyolab.com/common/map_user/ys_obc/v1/map/point/list?map_id=7&app_sn=ys_obc&lang=en-us";

    //  Initiate curl
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    return $result;
}

//api map Underground Mines
function UndergroundMines(){
    $url ="https://sg-public-api-static.hoyolab.com/common/map_user/ys_obc/v1/map/point/list?map_id=9&app_sn=ys_obc&lang=en-us";

    //  Initiate curl
    $ch = curl_init();
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    return $result;
}