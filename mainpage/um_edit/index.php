<?php
include "../../config/config_all.php";
$um_code = $_GET['c'];
$post = $share = $gum_code = $file_path = "";
$get_query = mysqli_query($conn, "SELECT * FROM umum WHERE um_code='$um_code' ")or die(mysqli_error());
while($res = mysqli_fetch_array($get_query)){
    $post = $res['post'];
    $share = $res['share'];
    $gum_code = $res['gum_code'];
    $file_path = $res['file_path'];
}
if($share == "all"){
    $share_out = "<option value='all'>Sema ( Umum )</option><option value='".$grup_code_ac."'>Grup</option>";
}else{
    $share_out = "<option value='".$grup_code_ac."'>Grup</option><option value='all'>Sema ( Umum )</option>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../script/bootstrap/css/bootstrap.min.css">
    <script src="../../script/jquery/jquery.js"></script>
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../script/jquery/jquery.form.js"></script>
<style>
body,
html{
    font-family: arial;
}
.divbody{
    position: relative;
    width: 500px;
    margin: auto;
}
.img_box{
    position: relative;
    margin: 10px 0px;
    width: 49%;
    display: inline-block;
}
#btndel{
    position: absolute;
    right: 0px;
    bottom: 0px;
}
@media screen and (max-width: 510px){
    .divbody{
        width: 98%;
    }
    .img_box{
        display: block;
        margin: auto;
        width: 90%;
    }
}
</style>
</head>
<body>

<div class="divbody">
    <form method="post" action="saveum.php">
        <br>
        <div style="font-size: 18px;">
            Bagikan Ke
            <select id="share" style="padding: 2px;" name="share">
                <?php echo $share_out; ?>
            </select>
        </div>
        <textarea id="post" name="post" class="form form-control" style="height: 150px;"><?php echo $post ?></textarea>
        <input type="hidden" value="<?php echo $um_code; ?>" name="c">
        <input onclick="value = 'Loading';" class="btn btn-success" style="position: absolute;bottom: 0px;right: 0px;" type="submit" value="Simpan">
    </form>
    <div id="seepict">
        <?php
            $get_query2 = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ")or die(mysqli_error($conn));
            while($res2 = mysqli_fetch_array($get_query2)){
                echo "<div id='".$res2['id']."' class='img_box'><img class='img-thumbnail' src='../../umum/thumbnail".$res2['path']."'><button id='btndel' pathattr='".$res2['path']."' idattr='".$res2['id']."' class='btn btn-danger'>Hapus</button></div>";
            }
        ?>
    </div>
    <div id="loadpict" style="display: none;position: fixed;top: 0px;right: 0px;left: 0xp;bottom: 0px;width: 100%;height: 100%;background-color: rgba(229, 239, 241, 0.7);z-index: 2;">
        <div style="position: fixed;width: 250px;height: 250px;margin: auto;top: 0px;right: 0px;left: 0px;bottom: 0px;margin: auto;">
            <div style="width: 150px;height: 150px;overflow: hidden;margin: auto;">
                <img style="width: 150px;height: auto;margin: auto;" src="../../system/icon/upload_process.gif">
            </div>
            <div id="loadpicttxt" style="text-align: center;font-size: 20px;">
                Loading
                <br>
                Memproses Data
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", "#btndel", function(){
            var path = $(this).attr("pathattr");
            var id = $(this).attr("idattr");
            $(this).html("Loading");
            $.ajax({
                method:"post",
                url:"del.php",
                data:{path:path,
                      id:id},
                dataType:"text",
                success:function(){
                    $("#"+id).fadeOut();
                }
            });
        });
    </script>
    <div>
            <label id="labelfilepost" for="filepost" class="btn btn-dark">Tambah Foto</label>
            <input onchange="savepict();" type='file' name='images[]' id="filepost" style="display: none;">
            <div id="filepost2" pathattr="<?php echo $file_path; ?>"></div>
    </div>
    <script>
        function savepict(){
            var dataz = new FormData();
            var pict = $("#filepost")[0].files[0];
            var filepath = $("#filepost2").attr("pathattr");
            dataz.append("images[]", pict);
            dataz.append("file_path", filepath);
            $.ajax({
                method:"post",
                url:"postpict.php",
                data: dataz,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $("#labelfilepost").html("Loading");
                    $("#loadpict").fadeIn();
                    $("#loadpicttxt").html("Loading<br>Memproses Data");
                },
                success:function(data){
                    $("#seepict").append(data);
                    $("#labelfilepost").html("Upload Gambar");
                    $("#loadpicttxt").html("Berhasil<br>Harap Tunggu Sebentar");
                    $("#loadpict").delay("2000").fadeOut();
                }
            });
        }
    </script>
<br><br>
</div>

</body>
</html>