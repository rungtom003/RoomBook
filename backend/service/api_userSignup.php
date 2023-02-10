<?php
include "../class/resp.php";
include "../config/connectiondb.php";

function uniqidReal($lenght = 13) {
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($lenght / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $lenght);
}

$resp = new Resp();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $ur_Id = $_POST["ur_Id"];
        $u_FirstName = $_POST["u_FirstName"];
        $u_LastName = $_POST["u_LastName"];
        $u_Username = $_POST["u_Username"];
        $u_Password = $_POST["u_Password"];
        $u_CardNumber = $_POST["u_CardNumber"];
        $u_OfficerId = $_POST["u_OfficerId"];
        $u_Position = $_POST["u_Position"];
        $u_Phone = $_POST["u_Phone"];
        $u_Prefix = $_POST["u_Prefix"];
        $u_Birthday = $_POST["u_Birthday"];
        $u_Address = $_POST["u_Address"];
        $u_Road = $_POST["u_Road"];
        $u_SubDistrict = $_POST["u_SubDistrict"];
        $u_District = $_POST["u_District"];
        $u_Province = $_POST["u_Province"];
        $z_Id = $_POST["z_Id"];
        $u_ShopName = $_POST["u_ShopName"];
        $u_ProductName = $_POST["u_ProductName"];

        $u_Password_hash = hash("sha256", $u_Password);
        $sql = "INSERT INTO ...";

        if ($conn->query($sql) === TRUE) {
            $resp->set_message("บันทึกข้อมูลสำเร็จ");
            $resp->set_status("success");
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
    $resp->set_status("fail");
}

echo json_encode($resp);
