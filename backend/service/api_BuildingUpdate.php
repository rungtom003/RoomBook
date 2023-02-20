<?php
include "../class/resp.php";
include "../config/connectiondb.php";

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        date_default_timezone_set("asia/bangkok");
        $bd_DateTimeUpdate = date("Y-m-d h:i:s");

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
        $bd_Lat = $_POST["bd_Lat"];
        $bd_Lng = $_POST["bd_Lng"];

        $sql = "UPDATE `room_book`.`tb_building` SET `bd_Name` = '" . $bd_Name . "', `bd_Floor` = '".$bd_Floor."', `bd_NumRoom`='".$bd_NumRoom."',";
        $sql .= "`bd_Detail`='".$bd_Detail."',`bd_Address`='".$bd_Address."',`bd_Road`='".$bd_Road."',`bd_Subdistrict`='".$bd_Subdistrict."', ";
        $sql .="`bd_District`='".$bd_District."',`bd_Province` = '".$bd_Province."', `bd_DateTimeUpdate` = '".$bd_DateTimeUpdate."',  ";
        $sql .= "`bd_Lat` = '".$bd_Lat."', `bd_Lng` = '".$bd_Lng."'  ";
        $sql .= "WHERE `bd_id` = '" . $bd_id . "';";

        $sqlCheck = "SELECT * FROM room_book.tb_building where bd_Name = '" . $bd_Name . "' and bd_id != '".$bd_id."' ;";
        $result = $conn->query($sqlCheck);

        if ($result->num_rows > 0) {
            $resp->set_message("ชื่ออาคารซ้ำ");
            $resp->set_status("Duplicate");
        } else {
            if ($conn->query($sql) === TRUE) {
                $resp->set_message("แก้ไขข้อมูลสำเร็จ");
                $resp->set_status("success");
            } else {
                $resp->set_message("ไม่สามารถบันทึกข้อมูลได้");
                $resp->set_status("fail");
            }
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
