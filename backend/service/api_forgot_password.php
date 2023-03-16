<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
$dataArr = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $u_Phone = $_POST['u_Phone'];
        $u_Username = $_POST['u_Username'];

        $sql = "SELECT * FROM room_book.tb_user where u_Phone = '".$u_Phone."' and u_Username = '".$u_Username."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                array_push($dataArr,$row);
            }
            $resp->data = $dataArr;
            $resp->set_status("success");
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
    $resp->set_status("fail");
}

echo json_encode($resp);
