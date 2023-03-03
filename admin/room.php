<?php
session_start();
$user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
if ($user == null) {
    header('location: /RoomBook/login_user.php');
} else {
    if ($user['ur_Id'] != "R002") // R002 => ADMIN
    {
        header('location: /RoomBook/index.php');
    }
}
$titleHead = "ห้อง";
$active_room = "active";
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
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="button" onclick="modal_Add()">เพิ่มห้อง</button>
                        </div>
                        <table id="table-room" class="table table-striped w-100"></table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="needs-validation" novalidate>
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addRoomModalLabel">เพิ่มห้อง</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <div class="col-md">
                                            <span id="r_Id" hidden></span>
                                            <label class="form-label">อาคาร</label>
                                            <select class="form-select" aria-label="Default select example" id="selectBuilding" required>
                                                <option selected value="">เลือกอาคาร</option>
                                            </select>
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                            <div class="invalid-feedback">
                                                กรุณาเลือก อาคาร
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label class="form-label">ประเภทห้อง</label>
                                            <select class="form-select" aria-label="Default select example" id="selectRoomType" required>
                                                <option selected value="">เลือกประเภทห้อง</option>
                                            </select>
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                            <div class="invalid-feedback">
                                                กรุณาเลือก ประเภทห้อง
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label for="" class="col-form-label">ชื่อห้อง</label>
                                            <input class="form-control" placeholder="Room name" id="inputR_Name" required></input>
                                            <div class="invalid-feedback">
                                                กรุณากรอก ชื่อห้อง
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md">
                                            <label for="" class="col-form-label">ชั้นที่</label>
                                            <input class="form-control" placeholder="Floor" id="inputR_Floor" required></input>
                                            <div class="invalid-feedback">
                                                กรุณากรอก ชั้นที่
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md">
                                            <label for="" class="col-form-label">จำนวนที่นั่ง</label>
                                            <input type="number" class="form-control" placeholder="0" id="inputR_Seats" required></input>
                                            <div class="invalid-feedback">
                                                กรุณากรอก จำนวนที่นั่ง
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="mb-3">
                                        <label for="" class="form-label">รายละเอียดเพิ่มเติม</label>
                                        <textarea class="form-control" placeholder="Detail" id="inputR_Detail" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <button type="submit" class="btn btn-primary" id="btn_Add">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script>
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        //Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                event.preventDefault()
                event.stopPropagation()
                if (form.checkValidity()) {
                    let txt = $('#addRoomModalLabel').html();
                    if (txt === "เพิ่มห้อง") {
                        room_Add();
                    } else if (txt === "แก้ไขข้อมูล") {
                        room_Update();
                    }

                }
                form.classList.add('was-validated');
            }, false)
        })

        function room_Load() {
            $.ajax({
                url: "/RoomBook/backend/service/api_RoomList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    LoadTable(res.data);
                }
            });

            const LoadTable = (data) => {
                $('#table-room').DataTable({
                    data: data,
                    // dom: 'Bfrtip',
                    // buttons: ['copy', 'csv', 'excel', 'colvis'],
                    responsive: true,
                    language: {
                        url: '../src/assets/DataTables/LanguageTable/th.json'
                    },
                    columnDefs: [{
                            targets: 0,
                            title: "อาคาร",
                            data: "bd_Name",
                        },
                        {
                            targets: 1,
                            title: "ประเภทห้อง",
                            data: "rt_Name"
                        },
                        {
                            targets: 2,
                            title: "ชื่อห้อง",
                            data: "r_Name",
                        },
                        {
                            targets: 3,
                            title: "ชั้นที่",
                            data: "r_Floor",
                        },
                        {
                            targets: 4,
                            title: "ที่นั่ง",
                            data: "r_Seats",
                        },
                        {
                            targets: 5,
                            title: "รายละเอียด",
                            data: "r_Detail",
                        },
                        {
                            targets: 6,
                            title: "#",
                            data: null,
                            defaultContent: "",
                            render: function(data, type, row, meta) {
                                const r_Id = row.r_Id;
                                let txtBtn = `<div class="d-grid gap-2 d-md-block" >
                                        <button class="btn btn-warning" type="button" onclick="modal_Update(this)" value="${r_Id}" id="btn_Edit" >แก้ไข</button>
                                        <button class="btn btn-danger" type="button" onclick="room_Delete(this)" value='${JSON.stringify(row)}' id="btn_Delete" >ลบ</button>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-success" type="button" id="btn_Update" style='display: none' >ยืนยัน</button>
                                        <button class="btn btn-danger" type="button" id="btn_Cancel" style='display: none' >ยกเลิก</button>
                                    </div>`;
                                return txtBtn;
                            }
                        }
                    ]
                });
            }
        }
        room_Load();

        function building_Load(elm) {
            $.ajax({
                url: "/RoomBook/backend/service/api_BuildingList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    let length = res.data.length;
                    $('#selectBuilding').empty()
                    if (elm == "") {
                        $('#selectBuilding').append(`<option selected value="">เลือก</option>`);
                    }
                    for (let i = 0; i < length; i++) {
                        if (elm == res.data[i].bd_id) {
                            $('#selectBuilding').append(`<option selected value="${res.data[i].bd_id}">${res.data[i].bd_Name}</option>`);
                        } else {
                            $('#selectBuilding').append(`<option value="${res.data[i].bd_id}">${res.data[i].bd_Name}</option>`);
                        }

                    }
                }
            });
        }

        function roomType_Load(elm) {
            $.ajax({
                url: "/RoomBook/backend/service/api_RoomTypeList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    let length = res.data.length;
                    $('#selectRoomType').empty()
                    if (elm == "") {
                        $('#selectRoomType').append(`<option selected value="">เลือก</option>`);
                    }
                    for (let i = 0; i < length; i++) {
                        if (elm == res.data[i].rt_Id) {
                            $('#selectRoomType').append(`<option selected value="${res.data[i].rt_Id}">${res.data[i].rt_Name}</option>`);
                        } else {
                            $('#selectRoomType').append(`<option value="${res.data[i].rt_Id}">${res.data[i].rt_Name}</option>`);
                        }

                    }
                }
            });
        }

        function modal_Add() {
            building_Load("");
            roomType_Load("");
            $('#addRoomModalLabel').html("เพิ่มห้อง");
            $('#inputR_Name').val("");
            $('#inputR_Floor').val("")
            $('#inputR_Detail').val("")
            $('#addRoomModal').modal('show');
        }

        function modal_Update(elm) {
            let r_Id = elm.value
            $('#addRoomModalLabel').html("แก้ไขข้อมูล");
            $.ajax({
                url: "/RoomBook/backend/service/api_RoomDetail.php",
                type: "POST",
                data: {
                    r_Id: r_Id
                },
                dataType: "json",
                success: function(res) {
                    let bd_Id = res.data.bd_Id;
                    let rt_Id = res.data.rt_Id;
                    let r_Img = res.data.r_Img;

                    building_Load(bd_Id)
                    roomType_Load(rt_Id)
                    $('#r_Id').val(res.data.r_Id)
                    $('#inputR_Name').val(res.data.r_Name)
                    $('#inputR_Floor').val(res.data.r_Floor)
                    $('#inputR_Detail').val(res.data.r_Detail)
                    $('#inputR_Seats').val(res.data.r_Seats)
                    $('#addRoomModal').modal('show')

                }
            });
        }

        function room_Add() {

            let bd_Id = $('#selectBuilding').val()
            let rt_Id = $('#selectRoomType').val()
            let r_Name = $('#inputR_Name').val()
            let r_Floor = $('#inputR_Floor').val()
            let r_Detail = $('#inputR_Detail').val()
            let r_Seats = $('#inputR_Seats').val()

            const formData = new FormData();
            formData.append("bd_Id", bd_Id);
            formData.append("rt_Id", rt_Id);
            formData.append("r_Name", r_Name);
            formData.append("r_Floor", r_Floor);
            formData.append("r_Detail", r_Detail);
            formData.append("r_Seats", r_Seats);

            $.ajax({
                url: "/RoomBook/backend/service/api_RoomAdd.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    let message = res.message;
                    let status = res.status;
                    if (status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.reload();
                        })

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เเจ้งเตือน',
                            text: message
                        })
                    }
                }
            });
        }

        function room_Delete(elm) {
            let obj = JSON.parse(elm.value);
            let r_Id = obj.r_Id;
            let r_Name = obj.r_Name;

            Swal.fire({
                title: 'แจ้งเตือน',
                text: `ต้องการลบข้อมูล ${r_Name} ใช่หรือไม่`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/RoomBook/backend/service/api_RoomDelete.php",
                        type: "POST",
                        data: {
                            r_Id: r_Id
                        },
                        dataType: "json",
                        success: function(res) {
                            //console.log(res);
                            let message = res.message;
                            let status = res.status;

                            if (status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: message,
                                    showConfirmButton: true,
                                    timer: 1500
                                }).then((result) => {
                                    $('#table-room').DataTable().destroy();
                                    room_Load();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เเจ้งเตือน',
                                    text: message
                                })
                            }
                        }
                    });

                }
            })
        }

        function room_Update() {
            let r_Id = $('#r_Id').val();
            let bd_Id = $('#selectBuilding').val()
            let rt_Id = $('#selectRoomType').val()
            let r_Name = $('#inputR_Name').val()
            let r_Floor = $('#inputR_Floor').val()
            let r_Detail = $('#inputR_Detail').val()
            let r_Seats = $('#inputR_Seats').val()

            const formData = new FormData();
            formData.append("r_Id", r_Id);
            formData.append("bd_Id", bd_Id);
            formData.append("rt_Id", rt_Id);
            formData.append("r_Name", r_Name);
            formData.append("r_Floor", r_Floor);
            formData.append("r_Detail", r_Detail);
            formData.append("r_Seats", r_Seats);

            $.ajax({
                url: "/RoomBook/backend/service/api_RoomUpdate.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(res) {
                    let message = res.message;
                    let status = res.status;
                    if (status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.reload();
                        })

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เเจ้งเตือน',
                            text: message
                        })
                    }

                }
            });
        }
    </script>
</body>

</html>