<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "สมัครสมาชิก";
$active_home = "active";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titleHead ?></title>
    <?php include("./layout/css.php"); ?>
</head>
<style>
    /* Import Google font - Poppins */
    /* @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"); */

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        /* font-family: "Poppins", sans-serif; */
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background-image: url("./src/img/S__34299923.jpg");
        background-size: cover;
    }

    .container {
        position: relative;
        max-width: 700px;
        width: 100%;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .container header {
        font-size: 1.5rem;
        color: #333;
        font-weight: 500;
        text-align: center;
    }

    .container .form {
        margin-top: 30px;
    }

    .form .input-box {
        width: 100%;
        margin-top: 20px;
    }

    .input-box label {
        color: #333;
    }

    .form :where(.input-box input, .select-box) {
        position: relative;
        height: 50px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: #707070;
        margin-top: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0 15px;
    }

    .input-box input:focus {
        box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    }

    .form .column {
        display: flex;
        column-gap: 15px;
    }

    .form .gender-box {
        margin-top: 20px;
    }

    .gender-box h3 {
        color: #333;
        font-size: 1rem;
        font-weight: 400;
        margin-bottom: 8px;
    }

    .form :where(.gender-option, .gender) {
        display: flex;
        align-items: center;
        column-gap: 50px;
        flex-wrap: wrap;
    }

    .form .gender {
        column-gap: 5px;
    }

    .gender input {
        accent-color: rgb(130, 106, 251);
    }

    .form :where(.gender input, .gender label) {
        cursor: pointer;
    }

    .gender label {
        color: #707070;
    }

    .address :where(input, .select-box) {
        margin-top: 15px;
    }

    .select-box select {
        height: 100%;
        width: 100%;
        outline: none;
        border: none;
        color: #707070;
        font-size: 1rem;
    }

    .form button {
        height: 55px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 400;
        margin-top: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        background: rgb(130, 106, 251);
    }

    .form button:hover {
        background: rgb(88, 56, 250);
    }

    /*Responsive*/
    @media screen and (max-width: 500px) {
        .form .column {
            flex-wrap: wrap;
        }

        .form :where(.gender-option, .gender) {
            row-gap: 15px;
        }
    }
</style>

<body style="font-family: kanit-Regular;">
    <section class="container">
        <header>ลืมรหัสผ่าน</header>
        <form class="form">

            <div class="mb-3">
                <label for="u_Username" class="form-label">Username</label>
                <input type="text" class="form-control" id="u_Username">
            </div>

            <div class="mb-3">
                <label for="u_Phone" class="form-label">เบอร์โทร</label>
                <input type="tel" class="form-control" id="u_Phone">
            </div>

            <button class="btn btn-primary" id="btn-ok">ยืนยัน</button>
            <div class="d-flex flex-row justify-content-center my-3">
                <a href="/RoomBook/login_user.php" class="btn btn-primary">กลับ</a>
            </div>

        </form>

    </section>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop_forgot" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel_forgot" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel_forgot">ตั้งรหัสผ่านใหม่</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">รหัสผ่านใหม่</label>
                        <input type="password" class="form-control" id="new_password">
                    </div>
                    <div class="mb-3">
                        <label for="new_password_comfirm" class="form-label">confirm password</label>
                        <input type="password" class="form-control" id="new_password_comfirm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary" id="btn-renew">ยืนยัน</button>
                </div>
            </div>
        </div>
    </div>

    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        const forgot_password = () => {

        }
        $("#btn-ok").click(function(e) {
            e.preventDefault();
            const myModal = new bootstrap.Modal('#staticBackdrop_forgot', {
                keyboard: false
            });

            const data = {
                u_Phone: $("#u_Phone").val(),
                u_Username: $("#u_Username").val()
            }

            $.ajax({
                url: '/RoomBook/backend/service/api_forgot_password.php',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.status === "success") {
                        myModal.show();
                    } else {
                        Swal.fire({
                            text: 'ไม่มีชื่อผู้ใช้หรือเบอร์โทรไม่ถูกต้อง ตรวจสอบข้อมูลให้ถูกต้อง',
                            icon: 'question'
                        });
                    }
                }
            });
        });

        $('#btn-renew').click(function(e) {
            e.preventDefault();
            const new_password = $("#new_password").val();
            const new_password_comfirm = $("#new_password_comfirm").val();

            if (new_password.length > 0) {
                if (new_password === new_password_comfirm) {
                    const data = {
                        password: $("#new_password").val(),
                        u_Username: $("#u_Username").val()
                    }
                    $.ajax({
                        url: '/RoomBook/backend/service/api_renew_password.php',
                        type: 'post',
                        dataType: 'json',
                        data: data,
                        success: function(res) {
                            if (res.status === "success") {
                                Swal.fire({
                                    text: res.message,
                                    icon: 'success',
                                    didClose: () => {
                                        window.location.replace('/RoomBook/login_user.php')
                                    }
                                });
                            } else {
                                Swal.fire({
                                    text: res.message,
                                    icon: 'question'
                                });
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        text: 'กรอกรหัสผ่านไม่ตรงกัน',
                        icon: 'question'
                    });
                }
            } else {
                Swal.fire({
                    text: 'กรุณากรอกรหัสผ่าน',
                    icon: 'warning'
                });
            }



        });
    </script>
</body>

</html>