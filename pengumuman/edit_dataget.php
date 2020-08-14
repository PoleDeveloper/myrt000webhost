<?php
include "../config/config_all.php";

$id = $_POST['id'];
$edg = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
while($rdg = mysqli_fetch_array($edg)){
    echo "<div class='divinner_form'>
            <form method='post' action='formpengedit.php' id='formpengedit'>
                <div class='form-group'>
                    <textarea name='isi' style='height: 200px;' class='form-control'>".$rdg['isi']."</textarea>
                    <br>
                    <input type='hidden' name='id' value='".$rdg['id']."' readonly>
                    <div style='text-align: right;'><input class='btn btn-success' type='submit' name='simpan' value='Bagikan'></div>
                </div>
            </form>
          </div>";
    $tanggal = date("l, d F Y", strtotime($rdg['date']));
}
?>
<script>
$("#formpengedit").ajaxForm({
    success:function(){
        $("#divbody_form").fadeOut();
        $("#um_load").fadeIn();
        $.ajax({
            method:"post",
            url:"get_data2.php",
            data:{id:<?php echo $id; ?>},
            dataType:"text",
            success:function(data){
                $("#<?php echo $id; ?>").html(data);
                $("#divinner_form1").fadeIn();
                $("#um_load").fadeOut();
                $("#divinner_form2").html(" ").fadeOut();
            }
        });
    }
});
</script>