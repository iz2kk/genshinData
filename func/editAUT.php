<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/function.php' ?>


<?php
if (!isset($_GET["id"])) {
    header("location: /convertJson.php");
    return;
}
require_once $_SERVER["DOCUMENT_ROOT"] . '/header.php';



$query =  FetchMaterial($_GET["id"]);
if ($query == false) {
    echo "item này không tồn tại hoặc đã bị xoá";
    return;
}
?>




<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">



<div class="container mt-3">
    <div class="form-add-material">
        <div class="form-header bg-primary">
            <h3>Sửa materials</h3>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-item">
                    <label for="name_material">Tên vật phẩm</label>
                    <input type="text" id="name_material" class="form-control" placeholder="Nhập tên vật phẩm">
                </div>
                <div class="form-item">
                    <label for="icon_link">Icon</label>
                    <input id="icon_link" type="text" class="form-control" placeholder="Dán url hình ảnh vào đây">
                </div>
                <div class="form-item">
                    <label for="description">Mô tả/Chú ý</label>
                    <textarea id="description" class="form-control" placeholder="Dán url download vào đây" rows="10" cols=""></textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-item">
                    <label for="download_link">Danh sách link download</label>
                    <textarea id="download_link" class="form-control" placeholder="Dán url download vào đây" rows="10" cols=""></textarea>
                </div>
                <div class=" form-item">
                    <label for="video_link">Danh sách link video</label>
                    <textarea id="video_link" class="form-control" placeholder="Dán ID youtube vào đây" rows="10" cols="">
                    </textarea>
                </div>


            </div>
        </div>
        <div class="notify">

        </div>
        <div class="button-group w-100">
            <button class="btn btn-primary d-block mx-auto mt-3" id="btn_update_Materials">Cập nhật</button>
        </div>
    </div>
</div>







<!----detect data--->
<script>
    //clear data before initiliaze
    localStorage.clear();

    $(document).ready(function() {
       const sumeditor = $("#description").summernote({
            height: "300",
            callbacks: {
                onChange: function(contents, $editable) {
                    localStorage.setItem("description", contents);
                }
            }
        });

        //set data
        $("#name_material").on("change input paste", function() {
            localStorage.setItem("title", $(this).val());
            let replace = removeTV($(this).val());
            localStorage.setItem("name", replace.replace(/\s/g, "_"));

        })
        $("#icon_link").on("change input paste", function() {
            localStorage.setItem("icon", $(this).val());
        })
        $("#description").on("change input paste", function() {
            localStorage.setItem("description", $(this).val());
        })
        $("#download_link").on("change input paste", function() {
            let downloadPlace = $(this).val().replace(/\s/g, "|");
            localStorage.setItem("download", downloadPlace);
        })
        $("#video_link").on("change input paste", function() {
            let video_link = $(this).val().replace(/\s/g, "|");
            localStorage.setItem("Video", video_link);
        })
    });
</script>
<!----push data--->
<script>
    $(document).ready(function() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        let id = urlParams.get('id');


        $.get("/ajax/ajax.php", {
            "item_id": id
        }, function(json) {
            let data = JSON.parse(json);
            if (data.id === undefined) {
                document.write("Lỗi ajax ko lấy được data");
                return;
            };
            // set local
            localStorage.setItem("id", id);
            localStorage.setItem("title", data.title);
            localStorage.setItem("name", data.title.replace(/\s/g, "_"));
            localStorage.setItem("icon", data.icon);
            localStorage.setItem("description", data.descrition);
            localStorage.setItem("download", data.download);
            localStorage.setItem("Video", data.Video);
            // set form

            //set data
            $("#name_material").val(data.title);
            $("#icon_link").val(data.icon);
            $("#description").summernote("code", data.descrition)
            $("#download_link").html(data.download.replace(/\|/g, "\n"));
            $("#video_link").html(data.Video.replace(/\|/g, "\n"));

            console.log(data);

        })
    });
</script>

<!----detect submit form--->

<script>
    $(document).ready(function() {
        $("#btn_update_Materials").click(function() {
            let dataJson = {
                "id": localStorage.getItem("id"),

                "name": `${localStorage.getItem("name")}`,
                "title": `${localStorage.getItem("title")}`,
                "icon": `${localStorage.getItem("icon")}`,
                "download": `${localStorage.getItem("download")}`,
                "descrition": `${localStorage.getItem("description")}`,
                "Video": `${localStorage.getItem("Video")}`
            }

            $.post("/ajax/ajax.php", {
                "update_material": `${JSON.stringify(dataJson)}`
            }, function(data) {
                // $(".notify").html(data);
                let json = JSON.parse(data);
                if (json.status == "ERROR") {
                    $(".notify").html(json.msg);
                    $(".notify").css("border", "1px solid red");
                    $(".notify").css("color", "red");

                }
                if (json.status == "OK") {
                    $(".notify").html(json.msg);
                    $(".notify").css("border", "1px solid green");
                    $(".notify").css("color", "green");

                }
                // localStorage.clear();
                // $("#name_material").val("");
                // $("#icon_link").val("");
                // $("#description").val("");
                // $("#download_link").val("");
                // $("#video_link").val("");
            })
        })
    });
</script>
<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/footer.php';


?>