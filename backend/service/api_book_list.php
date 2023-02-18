<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
$dataArr = array();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($connect_status == "success") {
        $sql = "SELECT DISTINCT a.b_ref,a.u_Id,b.u_Position,b.u_FirstName,b.u_LastName,b.u_Faculty,a.r_Id,c.r_Name,a.b_Head,ut_Id,a.b_NumParticipant,a.b_DateTime FROM  room_book.tb_Book as a inner join room_book.tb_user as b on a.u_Id = b.u_Id inner join room_book.tb_room as c on a.r_Id = c.r_Id where b_StatusCancel = '0';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($dataArr,$row);
            }
            $resp->data = $dataArr;
            $resp->set_status("seccess");
        }
        else{
            $resp->data = [];
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
