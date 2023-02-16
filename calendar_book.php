<?php
session_start();
$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
if ($user == null) {
    header('location: /RoomBook/login_user.php');
}

if ($user['ur_Id'] != "R001") // R001 => USER
{
    header('location: /RoomBook/admin/index.php');
}
$titleHead = "ปฏิทินการจอง";
$active_calendar_book = "active";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titleHead ?></title>
    <?php include("./layout/css.php"); ?>
</head>

<body style="font-family: kanit-Regular;">
    <?php include("./layout/head.php"); ?>
    <!-- start: Main -->
    <main class="bg-light">
        <div class="p-2">
            <?php include("./layout/navmain.php"); ?>
            <!-- start: Content -->
            <div class="py-1" style="font-family: kanit-Regular;">

                <div class="card my-1">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกอาคาร" id="select-building">
                                        <option selected disabled value=''>เลือกอาคาร</option>
                                    </select>
                                    <label for="select-building">อาคาร/ตึก</label>
                                </div>
                            </div>
                            <div class="col-sm-3 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกชั้น" id="select-floor">
                                        <option selected disabled value=''>เลือกชั้น</option>
                                    </select>
                                    <label for="select-floor">ชั้น</label>
                                </div>
                            </div>
                            <div class="col-sm-3 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกประเภทห้อง" id="select-roomtype">
                                        <option selected disabled value=''>เลือกประเภทห้อง</option>
                                    </select>
                                    <label for="select-roomtype">ประเภทห้อง</label>
                                </div>

                            </div>
                            <div class="col-sm-3 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกห้อง" id="select-room">
                                        <option selected disabled value=''>เลือกห้อง</option>
                                    </select>
                                    <label for="select-room">ห้อง</label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        let calendarEl = document.getElementById('calendar');
        let calendar;
        $(document).ready(function() {

            $.ajax({
                url: '/RoomBook/backend/service/api_select_book.php',
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    let buildingOption = `<option selected disabled value=''>เลือกอาคาร</option>`;
                    let floorOption = `<option selected disabled value=''>เลือกชั้น</option>`;
                    let roomtypeOption = `<option selected disabled value=''>เลือกประเภทห้อง</option>`;
                    let roomOption = `<option selected disabled value=''>เลือกห้อง</option>`;

                    $.each(res.data.building, function(key, val) {
                        buildingOption += `<option value="${val.bd_id}" data-floor="${val.bd_Floor}">${val.bd_Name}</option>`;
                    });

                    $.each(res.data.roomType, function(key, val) {
                        roomtypeOption += `<option value="${val.rt_Id}">${val.rt_Name}</option>`;
                    });

                    $("#select-building").html(buildingOption);
                    $("#select-roomtype").html(roomtypeOption);
                    $("#select-floor").html(floorOption);
                    $("#select-room").html(roomOption);
                }
            });

            $("#select-building").change(function() {
                let floorOption = "<option selected disabled value=''>เลือกชั้น</option>";
                const element = document.getElementById("select-building");
                let floor = element.options[element.selectedIndex].getAttribute("data-floor");
                let val = element.value;

                for (let i = 1; i <= floor; i++) {
                    floorOption += `<option value="${i}">${i}</option>`;
                }
                $("#select-floor").html(floorOption);

                const roomtype = $("#select-roomtype").val();
                const floorselect = $("#select-floor").val();
                const roomID = $("#select-room").val()

                calendar.refetchEvents()

            });

            $("#select-floor").change(function() {
                const building = $("#select-building").val();
                const roomtype = $("#select-roomtype").val();
                const roomID = $("#select-room").val()

                $.ajax({
                    url: '/RoomBook/backend/service/api_select_room.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        r_Floor: $(this).val(),
                        rt_Id: roomtype
                    },
                    success: function(res) {
                        let roomOption = `<option selected disabled value=''>เลือกห้อง</option>`;

                        $.each(res.data, function(key, val) {
                            roomOption += `<option value="${val.r_Id}">${val.r_Name}</option>`;
                        });
                        $("#select-room").html(roomOption);
                    }
                });
                calendar.refetchEvents()
            });

            $("#select-roomtype").change(function() {
                const building = $("#select-building").val();
                const floor = $("#select-floor").val();
                const roomID = $("#select-room").val()

                $.ajax({
                    url: '/RoomBook/backend/service/api_select_room.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        r_Floor: floor,
                        rt_Id: $(this).val()
                    },
                    success: function(res) {
                        let roomOption = `<option selected disabled value=''>เลือกห้อง</option>`;

                        $.each(res.data, function(key, val) {
                            roomOption += `<option value="${val.r_Id}">${val.r_Name}</option>`;
                        });
                        $("#select-room").html(roomOption);
                    }
                });
                calendar.refetchEvents()
            });

            $("#select-room").change(function() {
                const building = $("#select-building").val();
                const roomtype = $("#select-roomtype").val();
                const floor = $("#select-floor").val();
                calendar.refetchEvents()
            });

            calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th',
                //height: '100%',
                themeSystem: 'bootstrap5',
                expandRows: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true,
                //displayEventTime:true,
                //eventDisplay:"block",
                //progressiveEventRendering:true,
                eventTimeFormat: { // like '14:30:00'
                    hour: '2-digit',
                    minute: '2-digit',
                    //second: '2-digit',
                    hour12: false
                },
                // dayPopoverFormat: {
                //     day: 'dddd, MMMM D, YYYY'
                // },
                eventDidMount: function(info) {
                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body',
                        html: true,
                    });
                    //var popover = info.el.getElementsByClassName('fc-event-title')[0];
                },
                events: {
                    url: '/RoomBook/backend/service/api_book_carendar.php',
                    method: 'GET',
                    extraParams: function() {
                        return {
                            bd_Id: $("#select-building").val() === null ? "" : $("#select-building").val(),
                            r_Floor: $("#select-floor").val() === null ? "" : $("#select-floor").val(),
                            rt_Id: $("#select-roomtype").val() === null ? "" : $("#select-roomtype").val(),
                            r_Id: $("#select-room").val() === null ? "" : $("#select-room").val()
                        };
                    },
                    failure: function() {
                        alert('there was an error while fetching events!');
                    }
                },
                eventSourceSuccess: function(content, response) {
                    //console.log(content);
                    //return content.eventArray;
                }
            });
            calendar.render();
        });
    </script>
</body>

</html>