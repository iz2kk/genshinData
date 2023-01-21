<?php
    require_once './header.php';
?>


<div class="container">
    <div id="notify" class="rows">

    </div>
</div>
<!----import label-->
<script>
    //enka
    $.get("/maps/getMap.php", {teyvat:'teyvat'}, function(js){

       let db = JSON.parse(js);
       ConsoleLog(["Map Data teyvat", db]);

       $.post("/ajax/ajax.php", {labelMap:`${JSON.stringify(db.data.label_list)}`,method: 'teyvat'}, function(data){
        $("#notify").append(data);  

        ConsoleLog(["log data",  db])
       })
    });

    //enka
    $.get("/maps/getMap.php", {enka:'enka'}, function(js){
       
       let db = JSON.parse(js);
       ConsoleLog(["Map Data enka", db]);

       $.post("/ajax/ajax.php", {labelMap:`${JSON.stringify(db.data.label_list)}`, method: 'enka'}, function(data){
        $("#notify").append(data);  

        ConsoleLog(["log data",  data])
       })
    });
      
      //Underground Mines
    $.get("/maps/getMap.php", {under:'under'}, function(js){
      
       let db = JSON.parse(js);
       ConsoleLog(["Map Data under", db]);

       $.post("/ajax/ajax.php", {labelMap:`${JSON.stringify(db.data.label_list)}`, method: 'under'}, function(data){
          $("#notify").append(data);  
        ConsoleLog(["log data",  data])
       })
    }); 


</script>

<!----import items-->
<script>
    //enka
    $.get("/maps/getMap.php", {teyvat:'teyvat'}, function(js){

       let db = JSON.parse(js);
       ConsoleLog(["Map Data teyvat", db]);

       $.post("/ajax/ajax.php", {item_maps:`${JSON.stringify(db.data.point_list)}`,method: 'teyvat_maps'}, function(data){
        $("#notify").append(data);  

        ConsoleLog(["log data",  db])
       })
    });

    //enka
    $.get("/maps/getMap.php", {enka:'enka'}, function(js){
       
       let db = JSON.parse(js);
       ConsoleLog(["Map Data enka", db]);

       $.post("/ajax/ajax.php", {item_maps:`${JSON.stringify(db.data.point_list)}`, method: 'enka_maps'}, function(data){
        $("#notify").append(data);  

        ConsoleLog(["log data",  data])
       })
    });

      
      //Underground Mines
    $.get("/maps/getMap.php", {under:'under'}, function(js){
      
       let db = JSON.parse(js);
       ConsoleLog(["Map Data under", db]);

       $.post("/ajax/ajax.php", {item_maps:`${JSON.stringify(db.data.point_list)}`, method: 'under_maps'}, function(data){
          $("#notify").append(data);  
        ConsoleLog(["log data",  data])
       })
    }); 


</script>