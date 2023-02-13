<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "อาคาร";
$active_building = "active";
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
                            <button class="btn btn-primary me-md-2" type="button" onclick="modal_Add()">เพิ่มอาคาร</button>
                        </div>
                        <table id="table-building" class="table table-striped w-100"></table>
                    </div>
                </div>
            </div>
            <!-- end: Content -->

            <div class="modal fade" id="buildingModal" tabindex="-1" aria-labelledby="buildingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="buildingModalLabel"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate>

                                <!-- <div class="d-flex justify-content-center">
                                    <img class="img-fluid" id="img" alt="" src="" style="height: 150px" >
                                </div> -->
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label class="form-label">ชื่ออาคาร</label>
                                        <input type="text" class="form-control" placeholder="Name" id="bd_Name" required>
                                        <!-- <div class="form-text">Enter your Full name</div> -->
                                        <div class="invalid-feedback">
                                            กรุณากรอก ชื่ออาคาร
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label">จำนวนชั้น</label>
                                        <input type="number" class="form-control" placeholder="Number of floors" id="bd_Floor" required>
                                        <!-- <div class="form-text">Enter your Full name</div> -->
                                        <div class="invalid-feedback">
                                            กรุณากรอก จำนวนชั้น
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-label">จำนวนห้องทั้งหมด</label>
                                        <input type="number" class="form-control" placeholder="Number of rooms" id="bd_NumRoom" required>
                                        <!-- <div  class="form-text">Enter your Last name</div> -->
                                        <div class="invalid-feedback">
                                            กรุณากรอก จำนวนห้อง
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="mb-3">
                                        <label for="u_ProductName" class="form-label">รายละเอียดเพิ่มเติม</label>
                                        <textarea class="form-control" rows="3" placeholder="Detail" id="bd_Detail"></textarea>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label class="form-label">ที่ตั้ง/หมู่</label>
                                            <input type="text" class="form-control" placeholder="Address" id="bd_Address" required>
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                            <div class="invalid-feedback">
                                                กรุณากรอก ที่ตั้ง/หมู่
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label class="form-label">ถนน</label>
                                            <input type="text" class="form-control" placeholder="Road" id="bd_Road">
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label class="form-label">ตำบล/แขวง</label>
                                            <input type="text" class="form-control" placeholder="Subdistrict" id="bd_Subdistrict" required>
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                            <div class="invalid-feedback">
                                                กรุณากรอก ตำบล/แขวง
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label class="form-label">อำเภอ</label>
                                            <input type="text" class="form-control" placeholder="District" id="bd_District" required>
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                            <div class="invalid-feedback">
                                                กรุณากรอก อำเภอ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md">
                                            <label class="form-label">จังหวัด</label>
                                            <input type="text" class="form-control" placeholder="Province" id="bd_Province" required>
                                            <!-- <div  class="form-text">Enter your Last name</div> -->
                                            <div class="invalid-feedback">
                                                กรุณากรอก จังหวัด
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <button type="submit" class="btn btn-primary" id="btnSave">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                    if ($('#buildingModalLabel').html() === "เพิ่มอาคาร") {
                        building_Add();
                    } else if ($('#buildingModalLabel').html() === "แก้ไขข้อมูล") {
                        building_Update();
                    }
                }
                form.classList.add('was-validated');
            }, false)
        })

        function building_Load() {
            $.ajax({
                url: "/RoomBook/backend/service/api_BuildingList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    LoadTable(res.data);
                }
            });

            const LoadTable = (data) => {
                $('#table-building').DataTable({
                    data: data,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'colvis'],
                    responsive: true,
                    language: {
                        url: '../src/assets/DataTables/LanguageTable/th.json'
                    },
                    columnDefs: [{
                            targets: 0,
                            title: "ชื่ออาคาร",
                            data: "bd_Name",
                        },
                        {
                            targets: 1,
                            title: "จำนวนชั้น",
                            data: "bd_Floor"
                        },
                        {
                            targets: 2,
                            title: "จำนวนห้องทั้งหมด",
                            data: "bd_NumRoom",
                        },
                        {
                            targets: 3,
                            title: "รายละเอียด",
                            data: null,
                            defaultContent: "",
                            render: function(data, type, row, meta) {
                                const bd_id = row.bd_id;
                                let txtBtn = `<div class="d-grid gap-2 d-md-block" >
                                            <button class="btn btn-link" type="button" data-bs-toggle="modal" data-bs-target="#buildingModal" onclick="building_Detail(this)" value="${bd_id}">เพิ่มเติม</button>
                                            </div>`
                                return txtBtn;
                            }
                        },
                        {
                            targets: 4,
                            title: "#",
                            data: null,
                            defaultContent: "",
                            render: function(data, type, row, meta) {
                                const bd_id = row.bd_id;
                                const bd_Name = row.bd_Name;
                                let txtBtn = `<div class="d-grid gap-2 d-md-block" >
                                        <button class="btn btn-warning" type="button" onclick="modal_Update(this)" value="${bd_id}" id="btn_Edit" >แก้ไข</button>
                                        <button class="btn btn-danger" type="button" onclick="building_Delete(this)" value='${JSON.stringify(row)}' id="btn_Delete" >ลบ</button>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-success" type="button" id="btn_Update" style='display: none' >ยืนยัน</button>
                                        <button class="btn btn-danger" type="button" id="btn_Cancel" style='display: none' >ยกเลิก</button>
                                    </div>`;
                                let txtHTML = "";
                                return txtBtn;
                            }
                        }
                    ]
                });
            }
        }
        building_Load();

        const building_Detail = (elm) => {
            let bd_id = elm.value;
            $('#buildingModalLabel').html("รายละเอียดเพิ่มเติม");
            $('#btnSave').hide();
            $.ajax({
                url: "/RoomBook/backend/service/api_BuildingDetail.php",
                type: "POST",
                data: {
                    bd_id: bd_id
                },
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    $('#bd_Name').val(res.data.bd_Name).attr("placeholder", "").prop("readonly", true);
                    $('#bd_Floor').val(res.data.bd_Floor).attr("placeholder", "").prop("readonly", true);
                    $('#bd_NumRoom').val(res.data.bd_NumRoom).attr("placeholder", "").prop("readonly", true);
                    $('#bd_Detail').val(res.data.bd_Detail).attr("placeholder", "").prop("readonly", true);
                    $('#bd_Address').val(res.data.bd_Address).attr("placeholder", "").prop("readonly", true);
                    $('#bd_Road').val(res.data.bd_Road).attr("placeholder", "").prop("readonly", true);
                    $('#bd_Subdistrict').val(res.data.bd_Subdistrict).attr("placeholder", "").prop("readonly", true);
                    $('#bd_District').val(res.data.bd_District).attr("placeholder", "").prop("readonly", true);
                    $('#bd_Province').val(res.data.bd_Province).attr("placeholder", "").prop("readonly", true);
                }
            });
        }

        const modal_Add = () => {
            $('#buildingModalLabel').html("เพิ่มอาคาร");
            $('#bd_Name').val("").attr("placeholder", "Name").prop("readonly", false);
            $('#bd_Floor').val("").attr("placeholder", "Number of floors").prop("readonly", false);
            $('#bd_NumRoom').val("").attr("placeholder", "Number of rooms").prop("readonly", false);
            $('#bd_Detail').val("").attr("placeholder", "Detail").prop("readonly", false);
            $('#bd_Address').val("").attr("placeholder", "Address").prop("readonly", false);
            $('#bd_Road').val("").attr("placeholder", "Road").prop("readonly", false);
            $('#bd_Subdistrict').val("").attr("placeholder", "Subdistrict").prop("readonly", false);
            $('#bd_District').val("").attr("placeholder", "District").prop("readonly", false);
            $('#bd_Province').val("").attr("placeholder", "Province").prop("readonly", false);
            $('#btnSave').show();
            $('#buildingModal').modal('show');
        }

        const modal_Update = (elm) => {
            let bd_id = elm.value;
            $('#buildingModalLabel').html("แก้ไขข้อมูล");
            $.ajax({
                url: "/RoomBook/backend/service/api_BuildingDetail.php",
                type: "POST",
                data: {
                    bd_id: bd_id
                },
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    $('#bd_Name').val(res.data.bd_Name).attr("placeholder", "Name").prop("readonly", false);
                    $('#bd_Floor').val(res.data.bd_Floor).attr("placeholder", "Number of floors").prop("readonly", false);
                    $('#bd_NumRoom').val(res.data.bd_NumRoom).attr("placeholder", "Number of rooms").prop("readonly", false);
                    $('#bd_Detail').val(res.data.bd_Detail).attr("placeholder", "Detail").prop("readonly", false);
                    $('#bd_Address').val(res.data.bd_Address).attr("placeholder", "Address").prop("readonly", false);
                    $('#bd_Road').val(res.data.bd_Road).attr("placeholder", "Road").prop("readonly", false);
                    $('#bd_Subdistrict').val(res.data.bd_Subdistrict).attr("placeholder", "Subdistrict").prop("readonly", false);
                    $('#bd_District').val(res.data.bd_District).attr("placeholder", "District").prop("readonly", false);
                    $('#bd_Province').val(res.data.bd_Province).attr("placeholder", "Province").prop("readonly", false);
                    $('#btnSave').val(res.data.bd_id).show();
                }
            });

            $('#buildingModal').modal('show');
        }

        const building_Add = () => {
            let bd_Name = $('#bd_Name').val()
            let bd_Floor = $('#bd_Floor').val()
            let bd_NumRoom = $('#bd_NumRoom').val()
            let bd_Detail = $('#bd_Detail').val()
            let bd_Address = $('#bd_Address').val()
            let bd_Road = $('#bd_Road').val()
            let bd_Subdistrict = $('#bd_Subdistrict').val()
            let bd_District = $('#bd_District').val()
            let bd_Province = $('#bd_Province').val()

            const formData = new FormData();
            formData.append("bd_Name", bd_Name);
            formData.append("bd_Floor", bd_Floor);
            formData.append("bd_NumRoom", bd_NumRoom);
            formData.append("bd_Detail", bd_Detail);
            formData.append("bd_Address", bd_Address);
            formData.append("bd_Road", bd_Road);
            formData.append("bd_Subdistrict", bd_Subdistrict);
            formData.append("bd_District", bd_District);
            formData.append("bd_Province", bd_Province);

            $.ajax({
                url: "/RoomBook/backend/service/api_BuildingAdd.php",
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

                    } else if (status == "Duplicate") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เเจ้งเตือน',
                            text: message
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

        const building_Update = () => {
            let bd_id = $('#btnSave').val();
            let bd_Name = $('#bd_Name').val()
            let bd_Floor = $('#bd_Floor').val()
            let bd_NumRoom = $('#bd_NumRoom').val()
            let bd_Detail = $('#bd_Detail').val()
            let bd_Address = $('#bd_Address').val()
            let bd_Road = $('#bd_Road').val()
            let bd_Subdistrict = $('#bd_Subdistrict').val()
            let bd_District = $('#bd_District').val()
            let bd_Province = $('#bd_Province').val()

            const formData = new FormData();
            formData.append("bd_id", bd_id);
            formData.append("bd_Name", bd_Name);
            formData.append("bd_Floor", bd_Floor);
            formData.append("bd_NumRoom", bd_NumRoom);
            formData.append("bd_Detail", bd_Detail);
            formData.append("bd_Address", bd_Address);
            formData.append("bd_Road", bd_Road);
            formData.append("bd_Subdistrict", bd_Subdistrict);
            formData.append("bd_District", bd_District);
            formData.append("bd_Province", bd_Province);

            $.ajax({
                url: "/RoomBook/backend/service/api_BuildingUpdate.php",
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

                    } else if (status == "Duplicate") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เเจ้งเตือน',
                            text: message
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

        const building_Delete = (elm) => {
            let obj = JSON.parse(elm.value);
            let bd_id = obj.bd_id;
            let bd_Name = obj.bd_Name;

            Swal.fire({
                title: 'แจ้งเตือน',
                text: `ต้องการลบข้อมูล ${bd_Name} ใช่หรือไม่`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/RoomBook/backend/service/api_BuildingDelete.php",
                        type: "POST",
                        data: {
                            bd_id: bd_id
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
                                    $('#table-building').DataTable().destroy();
                                    building_Load();
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
    </script>
</body>

</html>