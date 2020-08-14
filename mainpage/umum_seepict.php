<?php
include ("../config/config_all.php");
$gum_code = $_POST['gum_code'];
$getq_query = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date ASC ")or die(mysqli_error($conn));
?>
<button onclick="pictureprev();" style="position: absolute;right: 0px;top: 0px;z-index: 2;border: none;font-size: 20px;border-bottom-left-radius: 50%;color: white;background-color: red;padding: 5px 8px 8px 12px;">X</button>
<div id='pitchdiv' style="position: relative;height: 80%;top: 0px;left: 0px;right: 0px;padding: 10px 5px;text-align: center;overflow: hidden;">
    <div class="pbWrapper"><img id="pitchframe" style='background-color: white;' src="system/icon/download.gif" class="zoomable"><div class="pbVideo zoomable"></div></div>
</div>
<div style="overflow-y: hidden;overflow-x: auto;white-space: nowrap;height: 20%;position: relative;">
<?php
while($resi = mysqli_fetch_array($getq_query)){
    echo "<a id='pitchchose' pathcattr='".$resi['path']."' style='display: inline-block;height: 100%;padding: 0px 3px;'><img class='img-thumbnail um_chosepict' style='height: 100%;width: auto;float: left;' src='../umum/thumbnail".$resi['path']."'></a>";
}
?>
</div>