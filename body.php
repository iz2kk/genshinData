<?php require_once './function.php' ?>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">



<div class="container">
    <div class="form-add-material">
        <div class="form-header">
            <h3>Thêm materials</h3>
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
                    <textarea id="video_link" class="form-control" placeholder="Dán ID youtube vào đây" rows="10" cols=""></textarea>
                </div>


            </div>
        </div>
        <div class="notify">

        </div>
        <div class="button-group w-100">
            <button class="btn btn-primary d-block mx-auto mt-3" id="btn_Add_Materials">Thêm</button>
        </div>
    </div>
</div>

<script>
   //clear data before initiliaze
   localStorage.clear();

    $(document).ready(function() {
        $("#description").summernote({
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


<script>
    $(document).ready(function() {
        $("#btn_Add_Materials").click(function() {
            let dataJson = {
                "name": `${localStorage.getItem("name")}`,
                "title": `${localStorage.getItem("title")}`,
                "icon": `${localStorage.getItem("icon")}`,
                "download": `${localStorage.getItem("download")}`,
                "descrition": `${localStorage.getItem("description")}`,
                "Video": `${localStorage.getItem("Video")}`
            }

            $.post("/ajax/ajax.php", {
                data: `${JSON.stringify(dataJson)}`
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
                localStorage.clear();
                $("#name_material").val("");
                $("#icon_link").val("");
                $("#description").val("");
                $("#download_link").val("");
                $("#video_link").val("");
            })
        })
    });
</script>