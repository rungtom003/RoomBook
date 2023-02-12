<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

$resp = new Resp();
$data_building = array();
$data_roomType = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {

        $sql = "SELECT * FROM room_book.tb_building;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data_building,$row);
            }
            $resp->set_status("seccess");
        }
        else{
            $resp->set_status("seccess");
            $resp->set_message("ไม่พบข้อมูล.");
        }

        $sqlroomType = "SELECT * FROM room_book.tb_roomType;";
        $resultroomType = $conn->query($sqlroomType);
        if ($resultroomType->num_rows > 0) {
            while($row = $resultroomType->fetch_assoc()) {
                array_push($data_roomType,$row);
            }
            $resp->set_status("seccess");
        }
        else{
            $resp->set_status("seccess");
            $resp->set_message("ไม่พบข้อมูล.");
        }

        $resp->data = array('building'=>$data_building,'roomType'=>$data_roomType);


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
