<?php

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

//$result = processDateTime("2023-02-16", "2023-02-28", "08:00", "12:00", array("Thursday", "Tuesday", "Sunday"));

$result = $_POST["test"];
echo var_dump($result);
