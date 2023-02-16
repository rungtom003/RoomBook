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
$titleHead = "ประเภทห้อง";
$active_roomType = "active";
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
                            <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addRoomTypeModal">เพิ่มประเภทห้อง</button>
                        </div>
                        <table id="table-roomType" class="table table-striped w-100"></table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addRoomTypeModal" tabindex="-1" aria-labelledby="addRoomTypeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="needs-validation" novalidate>
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addRoomTypeModalLabel">เพิ่มประเภทห้อง</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="inputAddRt_Id" class="col-form-label">รหัสประเภท</label>
                                        <input class="form-control" id="inputAddRt_Id" required></input>
                                        <div class="invalid-feedback">
                                            กรุณากรอก รหัสประเภท
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="inputAddRt_Name" class="col-form-label">ชื่อประเภท</label>
                                        <input class="form-control" id="inputAddRt_Name" required></input>
                                        <div class="invalid-feedback">
                                            กรุณากรอก ชื่อประเภท
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <button type="submit" class="btn btn-primary" onclick="" id="btn_Add">บันทึก</button>
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
                    roomType_Add();
                }
                form.classList.add('was-validated');
            }, false)
        })

        function roomType_Load() {
            $.ajax({
                url: "/RoomBook/backend/service/api_RoomTypeList.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    LoadTable(res.data);
                }
            });

            const LoadTable = (data) => {
                $('#table-roomType').DataTable({
                    data: data,
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'colvis'],
                    responsive: true,
                    language: {
                        url: '../src/assets/DataTables/LanguageTable/th.json'
                    },
                    columnDefs: [{
                            targets: 0,
                            title: "รหัสประเภทห้อง",
                            data: "rt_Id",
                        },
                        {
                            targets: 1,
                            title: "ชื่อประเภทห้อง",
                            data: "rt_Name",
                            render: function(data, type, row, meta) {
                                return '<td class=""><span id="rt_Name">' + data + '</span><input class="form-control" id="inputEditRt_Name" type="text" value="' + data + '" style="display: none; width: 100 % "></td>';
                            }
                        },
                        {
                            targets: 2,
                            title: "#",
                            width: "20%",
                            data: null,
                            defaultContent: "",
                            render: function(data, type, row, meta) {
                                let txtBtn = `<div class="d-grid gap-2 d-md-block" >
                                        <button class="btn btn-warning" type="button" id="btn_Edit" >แก้ไข</button>
                                        <button class="btn btn-danger" type="button" onclick="roomType_Delete(this)" value='${JSON.stringify(row)}' id="btn_Delete" >ลบ</button>
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
        roomType_Load();

        const roomType_Add = () => {
            let rt_Id = $('#inputAddRt_Id').val()
            let rt_Name = $('#inputAddRt_Name').val()
            $.ajax({
                url: "/RoomBook/backend/service/api_RoomTypeAdd.php",
                type: "POST",
                data: {
                    rt_Id: rt_Id,
                    rt_Name: rt_Name
                },
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

                    } else if (status == "Duplicate ID") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เเจ้งเตือน',
                            text: message
                        })

                    } else if (status == "Duplicate name") {
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

        const roomType_Delete = (elm) => {
            let obj = JSON.parse(elm.value);
            let rt_Id = obj.rt_Id;
            let rt_Name = obj.rt_Name;

            Swal.fire({
                title: 'แจ้งเตือน',
                text: `ต้องการลบ ${rt_Name} ใช่หรือไม่`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "/RoomBook/backend/service/api_RoomTypeDelete.php",
                        type: "POST",
                        data: {
                            rt_Id: rt_Id
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
                                    $('#table-roomType').DataTable().destroy();
                                    roomType_Load();
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

        //Btn Edit
        $("body").on("click", "#table-roomType #btn_Edit", function() {
            var row = $(this).closest("tr");

            $("td", row).each(function() {
                if ($(this).find("input").length > 0) {
                    $(this).find("input").show();
                    $(this).find("span").hide();
                }
            });

            row.find("#btn_Edit").hide();
            row.find("#btn_Delete").hide();
            row.find("#btn_Update").prop('disabled', true).show();
            row.find("#btn_Cancel").show();

            let input = row.find("#inputEditRt_Name").val();
            row.find('#inputEditRt_Name').keyup(function() {
                let val = row.find("#inputEditRt_Name").val();
                if (event.key != "Enter") {
                    if (val == input) {
                        row.find("#btn_Update").prop('disabled', true).show();
                    } else {
                        row.find("#btn_Update").prop('disabled', false).show();
                    }
                }
            })
        });

        //Btn Cancel
        $("body").on("click", "#table-roomType #btn_Cancel", function() {
            var row = $(this).closest("tr");
            $("td", row).each(function() {
                if ($(this).find("input").length > 0) {
                    $(this).find("input").hide();
                    $(this).find("span").show();
                }
            });
            row.find("#btn_Edit").show();
            row.find("#btn_Delete").show();
            row.find("#btn_Update").hide();
            row.find("#btn_Cancel").hide();

            let aName = row.find('#rt_Name').html();
            row.find("#inputEditRt_Name").val(aName);
        });

        //Btn Update
        $("body").on("click", "#table-roomType #btn_Update", function() {
            var row = $(this).closest("tr");
            let data = $('#table-roomType').DataTable().row(row).data();
            let rt_Id = data.rt_Id;
            let rt_Name = row.find("#inputEditRt_Name").val();

            if (rt_Name == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'เเจ้งเตือน',
                    text: 'ไม่มีข้อมูลที่จะแก้ไข'
                })
            } else {
                $.ajax({
                    url: "/RoomBook/backend/service/api_RoomTypeUpdate.php",
                    type: "POST",
                    data: {
                        rt_Id: rt_Id,
                        rt_Name: rt_Name
                    },
                    dataType: "json",
                    success: function(res) {
                        let message = res.message;
                        let status = res.status;

                        if (status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: message,
                                showConfirmButton: true,
                                timer: 1500
                            }).then((result) => {
                                $('#table-roomType').DataTable().destroy();
                                roomType_Load();
                            })
                        } else if (status == "Duplicate name") {
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
        });
    </script>
</body>

</html>