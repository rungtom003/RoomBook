<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $bd_id = $_POST["bd_id"];
        $bd_Name = $_POST["bd_Name"];
        $bd_Floor = $_POST["bd_Floor"];
        $bd_NumRoom = $_POST["bd_NumRoom"];
        $bd_Detail = $_POST["bd_Detail"];
        $bd_Address = $_POST["bd_Address"];
        $bd_Road = $_POST["bd_Road"];
        $bd_Subdistrict = $_POST["bd_Subdistrict"];
        $bd_District = $_POST["bd_District"];
        $bd_Province = $_POST["bd_Province"];

        $sql = "UPDATE `room_book`.`tb_building` SET `bd_Name` = '" . $bd_Name . "', `bd_Floor` = '".$bd_Floor."', `bd_NumRoom`='".$bd_NumRoom."',";
        $sql .= "`bd_Detail`='".$bd_Detail."',`bd_Address`='".$bd_Address."',`bd_Road`='".$bd_Road."',`bd_Subdistrict`='".$bd_Subdistrict."', ";
        $sql .="`bd_District`='".$bd_District."',`bd_Province` = '".$bd_Province."'  ";
        $sql .= "WHERE `bd_id` = '" . $bd_id . "';";

        if ($conn->query($sql) === TRUE) {
            $resp->set_message("แก้ไขข้อมูลสำเร็จ");
            $resp->set_status("success");

            // $sqlSelect = "SELECT * FROM reserve_space.tb_user where `u_Username` = '" . $u_Username . "' and `u_CardNumber` = '" . $u_CardNumber . "' ;";
            // $result = $conn->query($sqlSelect);
            // if ($result->num_rows > 0) {
            //     $row = $result->fetch_assoc();
            //     $resp->data = $row;
            //     $_SESSION["user"] = serialize($row);
            // }

        } else {
            $resp->set_message("ไม่สามารถบันทึกข้อมูลได้");
            $resp->set_status("fail");
        }
    } else {
        $resp->set_message("connection database fail.");
        $resp->set_status("fail");
    }
} else {
    $resp->set_message("Request method fail.");
    $resp->set_status("");
}

echo json_encode($resp);
