<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/function.php';

function UploadImgur($file)
{
    $curl = curl_init();
    $clientID="0d865493b08e016";
    $file = file_get_contents($file['tmp_name']);

    $base64img = base64_encode( $file);
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.imgur.com/3/image',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('image' =>   $base64img),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Client-ID $clientID"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $decode =  json_decode($response);
    // printArr($decode);

    if($decode->success == false){

        $data = $decode->data;

        return json_encode(array(
            "status" => "ERROR",
            "msg" => "Không up được ảnh nội dung lỗi".$data->error
        
        ), JSON_UNESCAPED_UNICODE);

    }else if($decode->success == true) {
            $data = $decode->data;

        return json_encode(array(
            "status" => "OK",
            "msg" => "Up Ảnh Thành Công",
            "link" => $data->link
        
        ), JSON_UNESCAPED_UNICODE);
    }


    // return stripslashes(json_encode($response, JSON_UNESCAPED_UNICODE));
}

function UploadFile($File){
    echo "File Assets: ";
    // printArr($File);

    return UploadImgur($File);
}