<?php require_once './function.php' ?>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<div class="container mt-3">
    <div class="menu">
        <a href="/convertJson.php">Export To Json</a>
    </div>
</div>

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
    function removeTV(str) {
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
        str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
        str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
        str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
        str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
        str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
        str = str.replace(/Đ/g, "D");
        // Some system encode vietnamese combining accent as individual utf-8 characters
        // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
        str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
        str = str.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
        // Remove extra spaces
        // Bỏ các khoảng trắng liền nhau
        str = str.replace(/ + /g, " ");
        str = str.trim();
        // Remove punctuations
        // Bỏ dấu câu, kí tự đặc biệt
        str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g, " ");
        return str;
    }


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