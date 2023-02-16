<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
$dataUsers = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {
        $sql = "SELECT * FROM room_book.tb_user inner join room_book.tb_userRole where room_book.tb_user.ur_Id = room_book.tb_userRole.ur_Id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($dataUsers,$row);
            }
            $resp->data = $dataUsers;
            $resp->set_status("seccess");
        }
        else{
            $resp->set_status("fail");
        }
    } else {
        $resp->set_message("connection database fail.");
        $resp->set_status("fail");
    }
}
else
{
    $resp->set_message("Request method fail.");
    $resp->set_status("");
}

echo json_encode($resp);
