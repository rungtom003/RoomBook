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

function processDateTime($datestart, $dateend, $timestart, $timeend, $day_of_w = [])
{
    $result = array();
    $time_start = $timestart;
    $time_end = $timeend;

    $date_start = date_create($datestart);
    $date_end = date_create($dateend);
    $dateend = date_add($date_end, date_interval_create_from_date_string("1 days"));

    $date_add = $date_start;

    $date_time_start = "";
    $date_time_end = "";

    $day_of_We = $day_of_w;


    for ($i = 0; $i < count($day_of_We); $i++) {
        //echo $day_of_We[$i]."<br>";
        while ($date_add != $date_end) {
            if (date_format($date_add, "l") == $day_of_We[$i]) {
                $date_time_start = date_create(date_format($date_add, "Y-m-d ") . $time_start);
                $date_time_end = date_create(date_format($date_add, "Y-m-d ") . $time_end);
                //echo date_format($date_time_start, "Y-m-d-l H:i:s") . " - " . date_format($date_time_end, "Y-m-d-l H:i:s") . "<br>";
                array_push($result, array('date_start' => date_format($date_time_start, "Y-m-d H:i:s"), 'date_end' => date_format($date_time_end, "Y-m-d H:i:s")));
            }
            $date_add = date_add($date_add, date_interval_create_from_date_string("1 days"));
        }
        $date_add = date_create($datestart);
    }

    return $result;
}

$resp = new Resp();
$data_arr = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($connect_status == "success") {

        $user = unserialize($_SESSION["user"]);
        $b_ref = uniqidReal();
        $u_Id = $user["u_Id"];
        $r_Id = $_POST["r_Id"];
        $b_Head = $_POST["b_Head"];
        $b_NumParticipant = $_POST["b_NumParticipant"];
        $b_StartDateTime = $_POST["b_StartDateTime"];
        $b_EndDateTime = $_POST["b_EndDateTime"];
        $b_Note = $_POST["b_Note"];
        $ut_Id = $_POST["ut_Id"];

        $timeStart = $_POST["timeStart"];
        $timeEnd = $_POST["timeEnd"];
        $day_of_w = $_POST["day_of_w"];

        $result_processDate = processDateTime($b_StartDateTime, $b_EndDateTime, $timeStart, $timeEnd, $day_of_w);

        $sql = "";

        for ($i = 0; $i < count($result_processDate); $i++) {

            $b_StartDateTime = $result_processDate[$i]["date_start"];
            $b_EndDateTime = $result_processDate[$i]["date_end"];

            $sql_check = "SELECT * FROM room_book.tb_Book  WHERE  (";
            $sql_check .= " ((b_StartDateTime >= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
            $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
            $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime <= '" . $b_EndDateTime . "')) OR";
            $sql_check .= " ((b_StartDateTime = '" . $b_StartDateTime . "' AND b_StartDateTime = '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime >= '" . $b_EndDateTime . "')) OR";
            $sql_check .= " ((b_StartDateTime <= '" . $b_StartDateTime . "' AND b_StartDateTime < '" . $b_EndDateTime . "') AND (b_EndDateTime = '" . $b_StartDateTime . "' AND b_EndDateTime = '" . $b_EndDateTime . "')) OR";
            $sql_check .= " ((b_StartDateTime > '" . $b_StartDateTime . "' AND b_StartDateTime <= '" . $b_EndDateTime . "') AND (b_EndDateTime > '" . $b_StartDateTime . "' AND b_EndDateTime <= '" . $b_EndDateTime . "'))) AND r_Id = '" . $r_Id . "';";
            $result = $conn->query($sql_check);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    array_push($data_arr, $row);
                }
                $resp->data = $data_arr;
                $resp->set_status("fail");
                $resp->set_message("เวลาในการจองทับกัน โปรดตรวจสอบวันเวลาจองห้อง");
                $sql = "";
                break;
            } else {
                $sql .= "INSERT INTO `room_book`.`tb_Book` (`b_Id`, `b_ref`, `u_Id`, `r_Id`, `b_Head`, `b_NumParticipant`, `b_StartDateTime`, `b_EndDateTime`, `b_Note` ,`ut_Id`) VALUES ('" . uniqidReal() . "', '".$b_ref."', '" . $u_Id . "', '" . $r_Id . "', '" . $b_Head . "', '" . $b_NumParticipant . "', '" . $b_StartDateTime . "', '" . $b_EndDateTime . "', '" . $b_Note . "', '" . $ut_Id . "');";

            }
        }

        if ($sql != "") {
            if ($conn->multi_query($sql) === TRUE) {
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
