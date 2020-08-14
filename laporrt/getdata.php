<?php
include "../config/config_all.php";
$id = $_POST['id'];
$getq = mysqli_query($conn, "SELECT * FROM laporrt WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
$count_getq = mysqli_num_rows($getq);
if($count_getq == 0){
    ?>
    <script>
        $("#listps").attr("loadattr", "2");
    </script>
    <?php
}else{
    while($lre = mysqli_fetch_array($getq)){
        echo "<div class='divinner_form'>
                <form method='post' action='laporac.php' id='formpengedit'>
                    <div class='form-group'>
                        <textarea name='isi' style='height: 200px;' class='form-control'>".$lre['isi']."</textarea>
                        <br>
                        <input type='hidden' name='id' value='".$lre['id']."' readonly>
                        <div style='text-align: right;'><input class='btn btn-success' type='submit' name='edit' value='Ubah Laporan'></div>
                    </div>
                </form>
              </div>";
        $tanggal = date("l, d F Y", strtotime($lre['upload_date']));
    }
}
?>
<script>
$("#formpengedit").ajaxForm({
    success:function(){
        $("#divbody_form").fadeOut();
        $("#um_load").fadeOut();
        upisi();
    }
});
function upisi(){
    $.ajax({
        method:"post",
        url:"upisi.php",
        data:{id:"<?php echo $id; ?>"},
        dataType:"text",
        success:function(data){
            $("#i<?php echo $id; ?>").html(data);
        }
    });
}
</script>