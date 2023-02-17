<?php
session_start();
$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
if ($user == null) {
    header('location: /RoomBook/login_user.php');
} else {
    if ($user['ur_Id'] != "R002") // R001 => USER
    {
        header('location: /RoomBook/index.php');
    }
}
$titleHead = "จัดการตารางสอน";
$active_classroom_timetable = "active";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titleHead ?></title>
    <?php include("./layout/css.php"); ?>

    <style>
        div.reserve-box-green {
            width: 80px;
            height: 80px;
            background: #229954;
            border-radius: 10px;
            margin: 5px;
            cursor: pointer;
            font-family: kanit-Regular;
            transition: background-color 0.5s
        }

        div.reserve-box-green:hover {
            background-color: #52BE80;
        }

        div.reserve-box-yellow {
            width: 80px;
            height: 80px;
            background: #F1C40F;
            border-radius: 10px;
            margin: 5px;
            cursor: pointer;
            font-family: kanit-Regular;
            transition: background-color 0.5s
        }

        div.reserve-box-yellow:hover {
            background-color: #F7DC6F;
        }


        div.reserve-box-red {
            width: 80px;
            height: 80px;
            background: #CB4335;
            border-radius: 10px;
            margin: 5px;
            cursor: pointer;
            font-family: kanit-Regular;
            transition: background-color 0.5s
        }

        div.reserve-box-red:hover {
            background-color: #EC7063;
        }

        div.reserve-box-primary {
            width: 80px;
            height: 80px;
            background: #3498DB;
            border-radius: 10px;
            margin: 5px;
            cursor: pointer;
            font-family: kanit-Regular;
            transition: background-color 0.5s
        }

        div.reserve-box-primary:hover {
            background-color: #85C1E9;
        }
    </style>

</head>

<body style="font-family: kanit-Regular;">
    <?php include("./layout/head.php"); ?>
    <!-- start: Main -->
    <main class="bg-light">
        <div class="p-2">
            <?php include("./layout/navmain.php"); ?>
            <!-- start: Content -->
            <div class="py-1" style="font-family: kanit-Regular;">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-4 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกอาคาร" id="select-building">
                                    </select>
                                    <label for="select-building">อาคาร/ตึก</label>
                                </div>
                            </div>
                            <div class="col-sm-4 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกชั้น" id="select-floor">
                                    </select>
                                    <label for="select-floor">ชั้น</label>
                                </div>
                            </div>
                            <div class="col-sm-4 my-1">
                                <div class="form-floating my-1">
                                    <select class="form-select" aria-label="เลือกประเภทห้อง" id="select-roomtype">
                                    </select>
                                    <label for="select-roomtype">ประเภทห้อง</label>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card my-1">
                    <div class="card-body">
                        <div class="d-flex justify-content-center flex-wrap" id="book-content">
                        </div>
                    </div>
                </div>


            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop-book_room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-book_room" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel-book_room">จองห้อง</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" novalidate>
                    <div class="modal-body">

                        <input type="text" class="form-control" id="r_Id" placeholder="รหัสห้อง" hidden>
                        <input type="text" class="form-control" id="r_Name" placeholder="รหัสห้อง" hidden>

                        <div class="form-floating my-1">
                            <input type="text" class="form-control" id="b_Head" placeholder="หัวข้อ" required>
                            <label for="b_Head">หัวข้อ</label>
                            <div class="invalid-feedback">
                                กรุณากรอกหัวข้อการจอง
                            </div>
                        </div>
                        <div class="form-floating my-1">
                            <select class="form-select" aria-label="ประเภทการใช้ห้อง" id="select-usetype" required>
                                <option value="" selected disabled>เลือกประเภทการใช้ห้อง</option>
                            </select>
                            <label for="select-usetype">ประเภทการใช้ห้อง</label>
                            <div class="invalid-feedback">
                                กรุณาเลือกประเภทการใช้ห้อง
                            </div>
                        </div>
                        <div class="form-floating my-1">
                            <input type="number" min="1" class="form-control" id="b_NumParticipant" placeholder="จำนวนผู้ใช้ห้อง">
                            <label for="b_NumParticipant">จำนวนผู้ใช้ห้อง</label>
                            <div class="invalid-feedback">
                                กรุณากรอกจำนวนผู้ใช้ห้อง
                            </div>
                        </div>
                        <div class="form-floating my-1">
                            <input type="text" class="form-control" name="date-start" id="date-start-end" placeholder="วันเริ่มต้น-วันสิ้นสุด" required />
                            <label for="date-start">วันเริ่มต้น-วันสิ้นสุด</label>
                            <div class="invalid-feedback">
                                กรุณากรอกวันเริ่มต้น-วันสิ้นสุด
                            </div>
                        </div>


                        <div class="my-2">
                            <span>ทำซ้ำ</span><br>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" id="Sunday" value="Sunday" name="day-w">
                                <label class="form-check-label" for="Sunday">อาทิตย์</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Monday" value="Monday" name="day-w">
                                <label class="form-check-label" for="Monday">จันทร์</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Tuesday" value="Tuesday" name="day-w">
                                <label class="form-check-label" for="Tuesday">อังคาร</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Wednesday" value="Wednesday" name="day-w">
                                <label class="form-check-label" for="Wednesday">พุธ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Thursday" value="Thursday" name="day-w">
                                <label class="form-check-label" for="Thursday">พฤหัสบดี</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Friday" value="Friday" name="day-w">
                                <label class="form-check-label" for="Friday">ศุกร์</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="Saturday" value="Saturday" name="day-w">
                                <label class="form-check-label" for="Saturday">เสาร์</label>
                            </div>
                            <div class="form-floating my-1">
                                <textarea class="form-control" placeholder="หมายเหตุเพิ่มเติม" id="b_Note" style="height: 100px"></textarea>
                                <label for="b_Note">หมายเหตุเพิ่มเติม</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" disabled hidden id="btn-load">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-close">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-book">จอง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        $.ajax({
            url: '/RoomBook/backend/service/api_select_book.php',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                let buildingOption = `<option selected disabled value=''>เลือกอาคาร</option>`;
                let floorOption = `<option selected disabled value=''>เลือกชั้น</option>`;
                let roomtypeOption = `<option selected disabled value=''>เลือกประเภทห้อง</option>`;
                let usetypeOption = `<option selected disabled value=''>เลือกประเภทห้อง</option>`;

                $.each(res.data.building, function(key, val) {
                    buildingOption += `<option value="${val.bd_id}" data-floor="${val.bd_Floor}">${val.bd_Name}</option>`;
                });

                $.each(res.data.roomType, function(key, val) {
                    roomtypeOption += `<option value="${val.rt_Id}">${val.rt_Name}</option>`;
                });

                $.each(res.data.useType, function(key, val) {
                    usetypeOption += `<option value="${val.ut_Id}" data-ut_Name="${val.ut_Name}">${val.ut_Name}</option>`;
                });

                $("#select-building").html(buildingOption);
                $("#select-roomtype").html(roomtypeOption);
                $("#select-floor").html(floorOption);
                $("#select-usetype").html(usetypeOption);
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

            loadContent(val, roomtype, floorselect);
        });

        $("#select-floor").change(function() {
            const building = $("#select-building").val();
            const roomtype = $("#select-roomtype").val();
            loadContent(building, roomtype, $(this).val());
        });

        $("#select-roomtype").change(function() {
            const building = $("#select-building").val();
            const roomtype = $(this).val();
            const floor = $("#select-floor").val();
            loadContent(building, $(this).val(), floor);
        });

        const modalbook_room = document.getElementById('staticBackdrop-book_room')
        modalbook_room.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            const room_json = button.getAttribute('data-bs-room');
            const room_obj = JSON.parse(room_json);
            $("#staticBackdropLabel-book_room").html(`จองห้อง # ${room_obj.r_Name}`);
            $("#r_Id").val(room_obj.r_Id);
            $("#r_Name").val(room_obj.r_Name);
        });

        $(document).ready(function() {


            $('#date-start-end').daterangepicker({
                "timePicker": true,
                "timePicker24Hour": true,
                "startDate": moment(),
                "endDate": moment(),
                minDate: moment().add(-1),
                locale: {
                    format: 'DD/MM/YYYY HH:mm:ss'
                },
            });

            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    event.preventDefault()
                    event.stopPropagation()
                    if (form.checkValidity()) {
                        bookSave();
                    }
                    form.classList.add('was-validated')
                }, false)
            });

        });


        const loadContent = (bd_Id = "", rt_Id = "", r_Floor = "") => {
            const data = {
                bd_Id: bd_Id,
                rt_Id: rt_Id,
                r_Floor: r_Floor
            }
            $.ajax({
                url: '/RoomBook/backend/service/api_list_rooms.php',
                type: 'POST',
                dataType: 'json',
                data: data,
                beforeSend: function() {
                    let txtHTML = `<div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                    </div>`;
                    $("#book-content").html(txtHTML);
                },
                success: function(res) {
                    let contentHTML = "";
                    $.each(res.data, function(key, val) {
                        contentHTML += `<div class="d-flex justify-content-center align-items-center reserve-box-green" data-bs-toggle="modal" data-bs-target="#staticBackdrop-book_room" data-bs-room='${JSON.stringify(val)}'>
                                            <span class="text-light text-center">${val.r_Name}</span>
                                        </div>`;
                    });
                    $("#book-content").html(contentHTML);
                }
            });
        }

        const bookSave = () => {
            let day_w = [];
            $.each($("input[name='day-w']"), function(key, val) {
                if ($(val).prop('checked') === true) {
                    day_w.push($(val).val());
                }
            });
            const Sunday = $("#Sunday").prop('checked') === true ? true : false;
            const startDate = $("#date-start-end").data('daterangepicker').startDate.format('YYYY-MM-DD');
            const endDate = $("#date-start-end").data('daterangepicker').endDate.format('YYYY-MM-DD');
            const startTime = $("#date-start-end").data('daterangepicker').startDate.format('HH:mm');
            const endTime = $("#date-start-end").data('daterangepicker').endDate.format('HH:mm');

            const element = document.getElementById("select-usetype");
            const ut_Name = element.options[element.selectedIndex].getAttribute("data-ut_Name");

            const data = {
                r_Id: $("#r_Id").val(),
                b_Head: $("#b_Head").val(),
                b_NumParticipant: $("#b_NumParticipant").val(),
                b_StartDateTime: startDate,
                b_EndDateTime: endDate,
                timeStart: startTime,
                timeEnd: endTime,
                day_of_w: day_w,
                b_Note: $("#b_Note").val(),
                ut_Id: $("#select-usetype").val(),
                ut_Name:ut_Name,
                r_Name:$("#r_Name").val()
            }

            if (day_w.length === 0) {
                Swal.fire(
                    'เลือกวันทำซ้ำ',
                    'กรุณาเลือกวันทำซ้ำ',
                    'warning'
                );
            } else {
                $.ajax({
                    url: '/RoomBook/backend/service/api_classroom_timetable.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    beforeSend: function() {
                        $("#btn-close").prop("hidden", true);
                        $(".btn-close").prop("hidden", true);
                        $("#btn-book").prop("hidden", true);
                        $("#btn-load").prop("hidden", false);
                    },
                    success: function(res) {
                        //console.log(res);
                        $("#btn-close").prop("hidden", false);
                        $(".btn-close").prop("hidden", false);
                        $("#btn-book").prop("hidden", false);
                        $("#btn-load").prop("hidden", true);

                        if (res.status === "success") {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: res.message,
                                showConfirmButton: false,
                                timer: 1500,
                                willClose: () => {
                                    window.location.reload();
                                }
                            });
                        } else {
                            Swal.fire(
                                'เกิดข้อผิดพลาด',
                                res.message,
                                'warning'
                            );
                        }
                    }
                });
            }
            //console.log(data);

        }
    </script>
</body>

</html>