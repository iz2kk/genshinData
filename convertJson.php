<?php
require_once "./function.php";
require_once "./lib.php";

$content = FetchData();
printArr($content);
$json = stripslashes(json_encode($content, JSON_UNESCAPED_UNICODE));

try {
    $myfile = fopen("materials.json", "w");
    fwrite($myfile, $json);
    fclose($myfile);
    echo "<font color='green'>Lưu file thành công!</font>";
} catch (Exception $e) {
    echo "<font color='red'>Lỗi lưu file: ". $e->getMessage()."</font>";
}

// ExportToJson();
echo "<textarea id='clm' style='width: 100%; height: 350px'>" . $json . "</textarea>";

?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {

        let value = $("#clm").val();
        let trm = JSON.stringify(value);
        let js = JSON.parse(value);

        console.log(js);
    });
</script>