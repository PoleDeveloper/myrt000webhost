<?php
    include "../config/config_all.php";

    $get_list = mysqli_query($conn, "SELECT * FROM pengajuan_surat_header WHERE grup_code='$grup_code_ac' ORDER BY upload_date ")or die(mysqli_error($conn));
    $gl_count = mysqli_num_rows($get_list);
    if($gl_count == 0){
        if($status_ac == "ketua"){
            echo "<h4 style='text-align: center;'>Anda Belum Membuat Daftar Pengajuan Surat</h4><br>Silahkan klik tombol ( Tambah Pengajuan Surat ) untuk membuat daftar pengajuan Surat";
        }else{
            echo "<h4 style='text-align: center;'>Ketua Rt Belum Membuat List Pengajuan Surat</h4>";
        }
    }else{
        $z = 1;
        while($rgl = mysqli_fetch_array($get_list)){
            echo "<tr>
                    <td style='5%;float: left;'>".$z.")</td>
                    <td style='float: left;width: 50%;padding-left: 3%;'>".$rgl['isi']."</td>
                    <td>";
                        if($status_ac == "ketua"){
                            echo "<button class='btn btn-Default'>Edit</button> <button class='btn btn-danger'>Hapus</button>";
                        }else{
                            echo "<button class='btn btn-primary'>Ajukan Surat</button>";
                        }
        echo     "  </td>
                  </tr>";
            $z++;
        }
    }
?>