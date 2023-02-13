<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

$resp = new Resp();
$data_arr = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {

        $sql = "SELECT * FROM room_book.tb_room as a  inner join room_book.tb_building as b on a.bd_Id = b.bd_Id inner join room_book.tb_roomType as c on a.rt_Id = c.rt_Id LIMIT 0, 1000";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data_arr,$row);
            }
            $resp->set_status("seccess");
            $resp->data = $data_arr;
        }
        else{
            $resp->data = [];
            $resp->set_status("seccess");
            $resp->set_message("ไม่พบข้อมูล.");
        }

    } else {
        $resp->set_message("connection database fail.");
        $resp->set_status("fail");
    }

}
else
{
    $resp->set_message("Request method fail.");
    $resp->set_status("fail");
}

echo json_encode($resp);
