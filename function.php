<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

require_once './lib.php';







function AddMaterial($input)
{
    //connect db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "AkebiGC";

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die('Không thể kết nối tới database');
    mysqli_set_charset($conn, 'UTF8');

    $data = json_decode($input, true);
   
    // printArr($input);
    
    $dataDownload = $data["download"]."|";
    $dataVideo = $data["Video"]."|";


    $name = $data["name"];
    $icon = $data["icon"];
    $title = $data["title"];
    $download = $dataDownload;
    $descrition = $data["descrition"];
    $Video = $dataVideo;
    $update = date("d/m/Y");
    // check  input
    if (NullCheck($name) || NullCheck($icon) || NullCheck($title) || NullCheck($download) || NullCheck($Video) || NullCheck($update)) {
        return json_encode(
            array(
                "status"=> "ERROR",
                "msg" => "Vui lòng điền đủ thông tin!"
            )
        );
    }
	if(NullCheck($descrition)){
		$descrition = "";
	}
	
    //**check in  db */
    if (mysqli_num_rows(mysqli_query($conn, "SELECT name FROM materials WHERE name='$name'")) > 0) {
        return json_encode(
            array(
                "status"=> "ERROR",
                "msg" => "Bạn đã thêm vật phẩm <b>$title</b>  này rồi"
            )
        );
    }
    $command = "INSERT INTO `materials`(`name`, `icon`, `title`, `download`, `descrition`, `Video`, `update`) VALUES ('$name','$icon','$title','$download','$descrition','$Video','$update')";
    $addQuery = mysqli_query($conn, $command);
    if ($addQuery) {
        return json_encode(
            array(
                "status"=> "OK",
                "msg" => "Thêm <b>$title </b>thành công!"
            )
        );
    } else {
        return json_encode(
            array(
                "status"=> "OK",
                "msg" => "Lỗi thêm <b>$title</b> vào database!"
            )
        );
    }

    mysqli_close($conn);

}

function FetchData(){
     //connect db
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "AkebiGC";
 
     $conn = mysqli_connect($servername, $username, $password, $dbname) or die('Không thể kết nối tới database');
     mysqli_set_charset($conn, 'UTF8');

     $command = "SELECT * FROM materials";
     $arry = array();
     $query = mysqli_query($conn,$command);
    while ($row = mysqli_fetch_assoc($query)) {
        $arry[] = $row;
    }
     mysqli_close($conn);
   
    return $arry;
}

