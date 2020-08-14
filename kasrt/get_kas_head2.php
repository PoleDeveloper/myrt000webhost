<?php

include "../config/config_all.php";

$data = array();
$no_b = 1;

if(isset($_POST['stat'])){

    $limit = $_POST['limit'];
    $sort = $_POST['sort'];
    if($sort == "1"){
        $sqlsort = "created_at DESC";
    }else if($sort == "2"){
        $sqlsort = "created_at ASC";
    }else if($sort == "3"){
        $sqlsort = "nama ASC";
    }


    if(isset($_POST['offset'])){
        $offset = $_POST['offset'];
    }else{
        $offset = 0;
    }
    $offsetnext = $offset+$limit;

    $page = $offset/$limit;
    $page = $page+1;

    $get = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' ORDER BY $sqlsort LIMIT $offset,$limit ")or die("error");
    $get_next = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' LIMIT $offsetnext,$limit ")or die("error");
    $get_all = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' ")or die("error");

    $count_get = mysqli_num_rows($get);
    $count_next = mysqli_num_rows($get_next);
    $count_all = mysqli_num_rows($get_all);

    $data['getlen'] = $count_get;

    $page_all = $count_all/$limit;

    if($count_get == 0 AND $offset == 0){
        $data['status'] = "0kas";
    }else if($count_get == 0 AND $offset > 0 ){
        $data['status'] = "reload";
        $data['offset_reload'] = $offset-$limit;
    }else if($count_get != 0){
        $data['status'] = "1";
        $no = $offset+1;
        $noarr = 0;
        while($res = mysqli_fetch_array($get)){
            $data['result'][$noarr] = array("no" => $no,
                                            "nama" => htmlspecialchars($res['nama']),
                                            "kas_code" => $res['kas_code']);
            if($status_ac == "bendahara"){
                $data['button'][$noarr] = array("button" => "<button id='bdelkh".$no_b."' attrchecked='0' attrkc='".$res['kas_code']."' style='transition: 0.2s;' onclick=\"delkash('".$res['kas_code']."', 'bdelkh".$no."');\" class=' btn btn-danger ld '>Hapus</button></td>");
            }else{
                $data['button'][$noarr] = array("button" => "");
            }
            $no++;
            $no_b++;
            $noarr++;
        }
    }

    if($status_ac == "bendahara"){
        $data['statusac'] = 1;
    }else{
        $data['statusac'] = 0;
    }

    $data['pagenow'] = $page;
    $data['totalpage'] = ceil($page_all);

    $data['nextoffset'] = $offset+$limit;
    $data['previousoffset'] = $offset-$limit;

    $data['attrkastotal'] = $count_get+1;
    $data['attridkhdelbtn'] = "bdelkh";
    $data['attridkhlhbtn'] = "blhkh";

    echo json_encode($data);

}

mysqli_close($conn);
?>