<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
$dataUsers = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {
        $sql = "SELECT a.r_Seats,a.r_Id,a.r_Name,a.r_Floor,a.r_Detail,a.r_Img,b.bd_Name, c.rt_Name FROM room_book.tb_room as a inner join room_book.tb_building as b on a.bd_Id = b.bd_Id ";
        $sql .="inner join room_book.tb_roomType as c on a.rt_Id = c.rt_Id;";
       
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
