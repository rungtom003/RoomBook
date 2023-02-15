<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "สมัครสมาชิก";
$signup_admin = "active";
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
                <div class="d-flex justify-content-center">
                    <div class="card col-lg-6">
                        <div class="card-header">
                            สมัครสมาชิก
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="u_FirstName" class="form-label">ชื่อ</label>
                                        <input type="text" class="form-control" placeholder="FirstName" id="u_FirstName" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก ชื่อ
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label for="u_LastName" class="form-label">นามสกุล</label>
                                        <input type="text" class="form-control" placeholder="LastName" id="u_LastName" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก สกุล
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="u_Faculty" class="form-label">คณะ</label>
                                        <input type="text" class="form-control" placeholder="Faculty" id="u_Faculty" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก คณะ
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label for="u_Position" class="form-label">ตำแหน่ง</label>
                                        <input type="text" class="form-control" placeholder="Position" id="u_Position" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก ตำแหน่ง
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="u_Username" class="form-label">รหัสประจำตัว</label>
                                        <input type="text" class="form-control" placeholder="๊Username" id="u_Username" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก ชื่อ
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="u_PasswordHash" class="form-label">รหัสผ่าน</label>
                                        <input type="Password" class="form-control" placeholder="Password" id="u_PasswordHash" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก รหัสผ่าน
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <div class="col-md">
                                        <label for="u_Phone" class="form-label">เบอร์ติดต่อ</label>
                                        <input type="text" class="form-control" placeholder="Phone" id="u_Phone" required>
                                        <div class="invalid-feedback">
                                            กรุณาเลือก เบอร์ติดต่อ
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2 p-2">
                                    <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>


            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        //Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                event.preventDefault()
                event.stopPropagation()
                if (form.checkValidity()) {
                    signup_Admin();
                }
                form.classList.add('was-validated');
            }, false)
        })


        function signup_Admin() {
            let u_FirstName = $('#u_FirstName').val()
            let u_LastName = $('#u_LastName').val()
            let u_Faculty = $('#u_Faculty').val()
            let u_Position = $('#u_Position').val()
            let u_Username = $('#u_Username').val()
            let u_PasswordHash = $('#u_PasswordHash').val()
            let u_Phone = $('#u_Phone').val()

            let data = {
                ur_Id : "R002",
                u_FirstName: u_FirstName,
                u_LastName: u_LastName,
                u_Faculty: u_Faculty,
                u_Position: u_Position,
                u_Username: u_Username,
                u_PasswordHash: u_PasswordHash,
                u_Phone: u_Phone
            }

            $.ajax({
                url: "/RoomBook/backend/service/api_userSignup.php",
                type: "POST",
                data: data,
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