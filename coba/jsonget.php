<?php
include "../config/config.php";
$data = array();
$data['status'] = 'ok';
$no = 0;
$get = mysqli_query($conn, "SELECT * FROM users_account ")or die(mysqli_error($conn));

while($row = mysqli_fetch_array($get)){
    $id = $row['id'];
    $email = $row['email'];

    $data['result'][$no] = array("id" => $id,
                                "email" => $email);

    $no++;
}

$data['datalen'] = $no;

echo json_encode($data);
?>