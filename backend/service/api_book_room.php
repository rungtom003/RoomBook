<?php
include "../class/resp.php";
include "../config/connectiondb.php";
session_start();

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
$data_arr = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $user = unserialize($_SESSION["user"]);

        $b_Id = uniqidReal();
        $u_Id = $user["u_Id"];
        $r_Id = $_POST["r_Id"];
        $b_Head = $_POST["b_Head"];
        $b_NumParticipant = $_POST["b_NumParticipant"];
        $b_StartDateTime = $_POST["b_StartDateTime"];
        $b_EndDateTime = $_POST["b_EndDateTime"];
        $b_Note = $_POST["b_Note"];
        $ut_Id = $_POST["ut_Id"];
        $r_Name = $_POST["r_Name"];
        $ut_Name = $_POST["ut_Name"];
        
        $sql = "INSERT INTO `room_book`.`tb_Book` (`b_Id`, `b_ref`, `u_Id`, `r_Id`, `b_Head`, `b_NumParticipant`, `b_StartDateTime`, `b_EndDateTime`, `b_Note` ,`ut_Id`) VALUES ('" . $b_Id . "', '" . uniqidReal() . "', '" . $u_Id . "', '" . $r_Id . "', '" . $b_Head . "', '" . $b_NumParticipant . "', '" . $b_StartDateTime . "', '" . $b_EndDateTime . "', '" . $b_Note . "', '" . $ut_Id . "');";

        $sql_check = "SELECT * FROM room_book.tb_Book  WHERE  (";
        $sql_check .= " ((b_StartDateTime >= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime <= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime = '" . $b_StartDateTime . "' AND b_StartDateTime = '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime = '" . $b_StartDateTime . "' AND b_EndDateTime = '" . $b_EndDateTime . "')) OR";
        $sql_check .= " ((b_StartDateTime > '" . $b_StartDateTime . "' AND b_StartDateTime <= '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime <= '" . $b_EndDateTime . "'))) AND r_Id = '" . $r_Id . "';";
        $result = $conn->query($sql_check);

        //เช็คว่ามีการจองห้องที่มีเวลาทับกันหรือไม่
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($data_arr, $row);
            }
            $resp->data = $data_arr;
            $resp->set_status("fail");
            $resp->set_message("เวลาในการจองทับกัน โปรดตรวจสอบวันเวลาจองห้อง");
        } else {
            //ถ้าไม่มีการจองห้องที่มีเวลาทับกันให้สามารถบันทึกข้อมูลการจองห้องได้
            if ($conn->query($sql) === TRUE) {

                $url        = 'https://notify-api.line.me/api/notify';
                $token      = 'RslyE40FjqXaTVn5bOih7xz2Rs37QWP5EMGrVjsX8Nw';
                $headers    = [
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' . $token
                ];
                $fields     = "message= จองห้อง"."\nหัวข้อ : ".$b_Head."\nชื่อ : ".$user['u_FirstName']." ".$user['u_LastName']."\nจองห้อง : ".$r_Name."\nประเภทการใช้ : ".$ut_Name."\nเวลาเริ่ม : ".$b_StartDateTime."\nเวลาสิ้นสุด : ".$b_EndDateTime;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                curl_close($ch);

                // var_dump($result);
                // $result = json_decode($result, TRUE);

                $resp->set_message("บันทึกข้อมูลสำเร็จ");
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
    $resp->set_status("fail");
}

echo json_encode($resp);
