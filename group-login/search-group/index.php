<?php
session_start();
if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    $email = $_SESSION['email'];
}
if(empty($email)){
    header("location: ../logout/");
}
//coonection and database config
include "../../config/config.php";
//account configuration
//get data
$get_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email LIKE '%$email%' ");
while($res = mysqli_fetch_array($get_query)){
    $user_code = $res['user_code'];
    $status = $res['status'];
    $grup = $res['grup_code'];
}
if(empty($status)){
    header("location: ../../group-login/");
}else if(!empty($grup)){
    header("location: ../../");
}
//dont copy this <end>
//end account configuration

$output = "";
$limit = 3;
$offset = "";
$btn_display = "none";
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    if(empty($offset)){
        $offset = 0;
    }
    $query = mysqli_query($conn, "SELECT * FROM grup WHERE jalan LIKE '%$search%' OR grup_code='$search' ORDER BY jalan ASC LIMIT $offset,$limit ")or die("GAGAL");
    $all_query = mysqli_query($conn, "SELECT * FROM grup WHERE jalan LIKE '%$search%' OR grup_code='$search' ");
    $total = mysqli_num_rows($all_query);
    if($total == 0){
        $output = "<div>Tidak Ada Hasil</div>";
    }else{
        while($res = mysqli_fetch_array($query)){
            $output .= "<tr>
                            <td class='td1'>".$res['jalan'].", ".$res['kelurahan']."
                            <div>
                                ".$res['kecamatan'].", ".$res['kota']."
                            </div></td>
                            <td class='td2'><button id='join' data-grup='".$res['grup_code']."' class='btn btn-success'>Gabung</button></td>
                        </tr>";
        }
        $btn_display = "inline-block";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Group</title>
    <link rel="stylesheet" href="../../script/bootstrap/css/bootstrap.min.css">
    <script src="../../script/jquery/jquery.js"></script>
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
<style>
html{
    font-family: arial;
}
.divbody{
    width: 100%;
    margin: auto;
    padding: 10px 5px;
}
.divform{
    width: 400px;
}

.divoutput{
    margin: auto;
    width: 100%;
    margin-top: 30px;
}
.table{
    width: 700px;
}
.td1{
    width: 80%;
}
.td2{
    width: 20%;
}
@media screen and (max-width: 700px){
    .table{
        width: 95%;
        margin: auto;
    }
}
@media screen and (max-width: 500px){
    .divform{
        width: 100%;
    }
}
</style>
</head>
<body>

<div class="divbody">
<div class="divform">
    <form method="post" action="">
        <input class="form-control" type="text" style="width: 80%;float: left;" name="search" placeholder="Nama Jalan Atau Kode Grup" required>
        <input class="btn" style="width: 20%;" type="submit" name="submit" name="Cari" Value="Cari">
    </form>
</div>

<div class="divoutput">
    <table class="table" CELLPADDING="5" id="loadtable">
        <?php echo $output; ?>
        <tr id="remove"><td style="text-align: center;" COLSPAN="2">
            <button style="display: <?php echo $btn_display; ?>;" type="button" name="loadmore" id="loadmore" data-search="<?php echo $search; ?>" data-limit="<?php echo $limit; ?>" data-offset="<?php echo $offset; ?>" class="btn btn-primary">Load More</button>
        </td></tr>
    </table>

</div>

</div>
<div class="coba"></div>
<script>
$(document).ready(function(){
    $(document).on('click', '#loadmore', function(){
        var search = $(this).data('search');
        var limit = $(this).data('limit');
        var offset = $(this).data('offset');
        $('#loadmore').html('loading...');
        $.ajax({
            url:"load_data.php",
            method:"POST",
            data:{
                search:search,
                limit:limit,
                offset,offset,
            },
            dataType:"text",
            success:function(data){
                if(data != ''){
                    $("#remove").remove();
                    $('#loadtable').append(data);
                }else{
                    $("#loadmore").html("No More Data");
                }
            }
        });
    });

    $(document).on('click', '#join', function(){
        var grup = $(this).data('grup');
        $('#join').html('Loading...');
        $.ajax({
            url:"join.php",
            method:"POST",
            data:{
                grup:grup,
            },
            dataType:"text",
            success:function(data){
                window.location = "../../group-login/";
            }
        })
    });
});
</script>
</body>
</html>