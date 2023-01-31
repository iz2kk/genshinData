<script src="/assets/js/lib.js"></script>


<div class="align-center">
    <div class="form-upload">
        <div class="form-item">
            <label for="">Chọn File Hình Ảnh</label>
            <input type="file" name="f_file" id="f_image" accept="image/*" value="Chọn Hình Ảnh">
        </div>
      
    </div>

    <div class="image-uploaded">

    </div>
</div>

<script>
    $(document).ready(function() {
  

        $('#f_image').on('change', function(e) {
            notify(".image-uploaded");
            let img = $("#f_image");
            var form = new FormData();
            form.append("image", img[0].files[0]);
            //Post to server
            $.ajax({
                type: "POST",
                url: "/ajax/ajax.php",
                processData: false,
                mimeType: "multipart/form-data",
                contentType: false,
                data: form,
                success: function(response) {

                    let js = JSON.parse(response);
                    console.log(js);
                    if (js.status === "OK") {
                        $(".image-uploaded").html(imgfield(js.link));
                        let valIcon =  $("#icon_link").val();
                        if(valIcon != undefined && valIcon == ""){
                            $("#icon_link").val(js.link);
                        }
                       
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    });
</script>