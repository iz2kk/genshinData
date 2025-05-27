<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/function.php";
require_once  $_SERVER["DOCUMENT_ROOT"] . "/lib.php";
require_once  $_SERVER["DOCUMENT_ROOT"] . '/header.php';
$content = FetchMaterials();
//printArr($content);
$json = stripslashes(json_encode($content, JSON_UNESCAPED_UNICODE));

if (isset($_GET["saveat"])) {
    // save json file
    try {
		
        $myfile = fopen("materials.json", "w");
        fwrite($myfile, $json);
        fclose($myfile);
        echo "<div class='text-center'> <font color='green'>Lưu file thành công!</font></div> ";
    } catch (Exception $e) {
        echo "<div class='text-center'> <font color='red'>Lỗi lưu file: " . $e->getMessage() . "</font></div> ";
    }
}

// ExportToJson();
// echo "<textarea id='clm' style='width: 100%; height: 350px'>" . $json . "</textarea>";

?>
<form action="" method="GET" class="button-group">
    <button name="saveat" class="btn btn-danger w-50 d-block">Lưu Json</button>
</form>
<div class="at-wrap">

        <div class="ant-row align-item-center">
            <?php
            foreach ($content as $key => $at) {

                echo '<div class="ant-col ant-col-xs-4 ant-col-sm-4 ant-col-xl-3 ant-col-xxl-3">';
                echo '<div class="at-gradient">';
                echo '<div class="at-thumb">';
                echo '<a href="/func/editAUT.php?id='.$at["id"].'" title="' . $at["title"] . '"><img src="' . $at["icon"] . '" alt="' . $at["title"] . '"></a>';
                echo '</div>';
                echo '</div>';
                echo '<div class="at-meta">
                            <div class="at-title">
                                <h3>' . $at["title"] . '</h3>
                            </div>
                
                         </div>';
                echo '</div>';
            }
            ?>
        </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {

        let value = $("#clm").val();
        let trm = JSON.stringify(value);
        let js = JSON.parse(value);

        console.log(js);
    });
</script>