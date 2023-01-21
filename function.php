<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib.php';
/**Materials */
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

    $dataDownload = $data["download"] . "|";
    $dataVideo = $data["Video"] . "|";


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
                "status" => "ERROR",
                "msg" => "Vui lòng điền đủ thông tin!"
            )
        );
    }
    if (NullCheck($descrition)) {
        $descrition = "";
    }

    //**check in  db */
    if (mysqli_num_rows(mysqli_query($conn, "SELECT name FROM materials WHERE name='$name'")) > 0) {
        return json_encode(
            array(
                "status" => "ERROR",
                "msg" => "Bạn đã thêm vật phẩm <b>$title</b>  này rồi"
            )
        );
    }
    $command = "INSERT INTO `materials`(`name`, `icon`, `title`, `download`, `descrition`, `Video`, `update`) VALUES ('$name','$icon','$title','$download','$descrition','$Video','$update')";
    $addQuery = mysqli_query($conn, $command);
    if ($addQuery) {
        return json_encode(
            array(
                "status" => "OK",
                "msg" => "Thêm <b>$title </b>thành công!"
            )
        );
    } else {
        return json_encode(
            array(
                "status" => "OK",
                "msg" => "Lỗi thêm <b>$title</b> vào database!"
            )
        );
    }

    mysqli_close($conn);
}

function FetchMaterials()
{
    //connect db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "AkebiGC";

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die('Không thể kết nối tới database');
    mysqli_set_charset($conn, 'UTF8');

    $command = "SELECT * FROM `materials` ORDER BY `materials`.`update` DESC";
    $arry = array();
    $query = mysqli_query($conn, $command);
    while ($row = mysqli_fetch_assoc($query)) {
        $arry[] = $row;
    }
    mysqli_close($conn);

    return $arry;
}

/**Maps */

function AddLabels($input, $method=false)
{

    //connect db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "AkebiGC";
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die('Không thể kết nối tới database');
    mysqli_set_charset($conn, 'UTF8');

    $js =  json_decode($input, true);
    if(!is_array($js) && !is_object($js)){
       
        echo "Kiểu dữ liệu không hợp lệ: ".gettype($js);
        return;
    }


    $default = "map_labels";
    if($method == "enka"){
        $default = "enka_map_labels";
    }else if($method == "under") {
        $default = "undeground_mines_labels";
    }


    echo "<div class='label-list col-4'><h3>Danh sách label đã thêm</h3>";

    // printArr($js);
    //import data to database
    foreach ($js as $key => $data) {


        $id = $data["id"];
        $name = $data["name"];
        $icon = $data["icon"];
        $clearName = RemoveSpace($name);

        // check  input
        if (!NullCheck($name) && !NullCheck($icon) && !NullCheck($clearName)) {
            //**check in  db */
            if (mysqli_num_rows(mysqli_query($conn, "SELECT `id`, `name` FROM `$default` WHERE name='$name' OR id=$id")) <= 0) {
                $command = "INSERT INTO `$default`(`id`, `name`, `icon`, `clear_name`) VALUES (' $id','$name','$icon','$clearName')";
                $addQuery = mysqli_query($conn, $command);
                if ($addQuery) {
                    echo "<p>Thêm label: <b>$name</b> thành công vào database  <b>$default</b>!</p>";
                } else {
                    echo "<p>Lỗi thêm label: <b>$name</b> vào database  <b>$default</b>!</p>";
                }
            }
        }
    }
echo "</div>";
    mysqli_close($conn);
}

function AddItems($input, $method=false)
{

    //connect db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "AkebiGC";

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die('Không thể kết nối tới database');
    mysqli_set_charset($conn, 'UTF8');


    $js =  json_decode($input, true);
   
    if(!is_array($js) && !is_object($js)){
       
        echo "Kiểu dữ liệu không hợp lệ: ".gettype($js);
        return;
    }


    $default = "teyvat_maps";
    if($method == "enka_maps"){
        $default = "enka_maps";
    }else if($method == "under_maps") {
        $default = "undeground_mines_maps";
    }

    echo "<div class='item-list col-4'><h3>Danh sách items đã thêm</h3>";

     printArr($js);
     
    //import data to database
    foreach ($js as $key => $data) {


        $id = $data["id"];
        $label_id = $data["label_id"];
        $x_pos = $data["x_pos"];
        $y_pos = $data["y_pos"];


        // check  input
        if (!NullCheck($id) && !NullCheck($x_pos) && !NullCheck($y_pos)) {
            //**check in  db */
            if (mysqli_num_rows(mysqli_query($conn, "SELECT `id`, `x_pos`, `y_pos` FROM `$default` WHERE id=$id OR x_pos= $x_pos  OR y_pos= $y_pos")) <= 0) {
                $command = "INSERT INTO `$default`(`id`, `label_id`, `x_pos`, `y_pos`) VALUES ('$id','$label_id',' $x_pos','$y_pos')";
                $addQuery = mysqli_query($conn, $command);
                if ($addQuery) {
                    echo "<p>Thêm map<b>($x_pos;$y_pos)</b> thành công! <b>$default</b></p>";
                } else {
                    echo "<p>Lỗi thêm map<b>($x_pos;$y_pos)</b> vào database <b>$default</b>!</p>";
                }
            }
        }
    }
    echo "</div>";


    mysqli_close($conn);
}
