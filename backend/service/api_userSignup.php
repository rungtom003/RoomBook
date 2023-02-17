<?php
include "../class/resp.php";
include "../config/connectiondb.php";

function uniqidReal($lenght = 13)
{
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
        $u_FirstName = $_POST["u_FirstName"];
        $u_LastName = $_POST["u_LastName"];
        $u_PasswordHash = $_POST["u_PasswordHash"];
        $u_Phone = $_POST["u_Phone"];
        $u_Faculty = $_POST["u_Faculty"];
        $u_Position = $_POST["u_Position"];
        $u_Username = $_POST['u_Username'];

        $sql = "SELECT * FROM room_book.tb_user where u_Username = '" . $u_Username . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $resp->set_message("มีชื่อผู้ใช้แล้ว");
            $resp->set_status("fail");
        } else {
            $u_Password_hash = hash("sha256", $u_PasswordHash);
            $sql = "INSERT INTO `room_book`.`tb_user` (`u_Id`, `ur_Id`, `u_FirstName`, `u_LastName`, `u_Username`, `u_PasswordHash`, `u_Phone`, `u_Faculty`, `u_Position`) VALUES ('" . uniqidReal() . "', 'R001', '" . $u_FirstName . "', '" . $u_LastName . "', '" . $u_Username . "', '" . $u_Password_hash . "', '" . $u_Phone . "', '" . $u_Faculty . "', '" . $u_Position . "');";

            if ($conn->query($sql) === TRUE) {
                $resp->set_message("สมัครสมาชิกมูลสำเร็จ");
                $resp->set_status("success");
            } else {
                $resp->set_message("ไม่สามารถสมัครสมาชิกได้");
                $resp->set_status("fail");
            }
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
