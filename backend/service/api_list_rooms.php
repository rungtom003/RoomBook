<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
$data_rooms = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {
        $bd_Id = $_POST["bd_Id"];
        $rt_Id = $_POST["rt_Id"];
        $r_Floor = $_POST["r_Floor"];

        $sql = "SELECT * FROM room_book.tb_room WHERE bd_Id LIKE '%".$bd_Id."%' and rt_Id LIKE '%".$rt_Id."%' and r_Floor LIKE '%".$r_Floor."%';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($data_rooms,$row);
            }
            $resp->data = $data_rooms;
            $resp->set_status("seccess");
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
