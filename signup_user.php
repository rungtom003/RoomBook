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
        <header>สมัครสมาชิก</header>
        <form class="form">
            <div class="column">
                <div class="input-box">
                    <label>ชื่อ</label>
                    <input type="text" placeholder="FirstName" id="u_FirstName" required />
                </div>
                <div class="input-box">
                    <label>นามสกุล</label>
                    <input type="text" placeholder="LastName" id="u_LastName" required />
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <label>คณะ</label>
                    <!-- <input type="text" placeholder="Faculty" id="u_Faculty" required /> -->
                    <div class="select-box" >
                        <select required id="u_Faculty">
                            <option value="" selected disabled>เลือกคณะ</option>
                            <option value="คณะเกษตร">คณะเกษตร</option>
                            <option value="คณะเกษตร">คณะบริหารธุรกิจ</option>
                            <option value="คณะเกษตร">คณะประมง</option>
                            <option value="คณะเกษตร">คณะมนุษยศาสตร์</option>
                            <option value="คณะเกษตร">คณะวนศาสตร์</option>
                            <option value="คณะเกษตร">คณะวิทยาศาสตร์</option>
                            <option value="คณะเกษตร">คณะวิศวกรรมศาสตร์</option>
                            <option value="คณะเกษตร">คณะศึกษาศาสตร์</option>
                            <option value="คณะเกษตร">คณะเศรษฐศาสตร์</option>
                            <option value="คณะเกษตร">คณะสถาปัตยกรรมศาสตร์</option>
                            <option value="คณะเกษตร">คณะสังคมศาสตร์</option>
                            <option value="คณะเกษตร">คณะสัตวแพทยศาสตร์</option>
                            <option value="คณะเกษตร">คณะอุตสาหกรรมเกษตร</option>
                            <option value="คณะเกษตร">คณะเทคนิคการสัตวแพทย์</option>
                            <option value="คณะเกษตร">คณะสิ่งแวดล้อม</option>
                            <option value="คณะเกษตร">คณะแพทยศาสตร์</option>
                        </select>
                    </div>
                </div>
                <div class="input-box">
                    <label>ตำแหน่ง</label>
                    <!-- <input type="text" placeholder="Position" id="u_Position" required /> -->
                    <div class="select-box" >
                        <select required id="u_Position">
                            <option value="" selected disabled>เลือกตำแหน่ง</option>
                            <option value="นักศึกษา">นักศึกษา</option>
                            <option value="อาจารย์">อาจารย์</option>
                            <option value="ศาสตราจารย์">ศาสตราจารย์</option>
                            <option value="รองศาสตราจารย์">รองศาสตราจารย์</option>
                            <option value="ผู้ช่วยศาสตราจารย์">ผู้ช่วยศาสตราจารย์</option>
                            <option value="เจ้าหน้าที่">เจ้าหน้าที่</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-box">
                <label>Username</label>
                <input type="text" placeholder="Username" id="u_Username" required />
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" placeholder="Password" id="u_PasswordHash" required />
            </div>

            <div class="input-box">
                <label>Phone Number</label>
                <input type="text" placeholder="Phone Number" id="u_Phone" required />
            </div>
            <!-- <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="number" placeholder="Enter phone number" required />
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" placeholder="Enter birth date" required />
                </div>
            </div> -->
            <!-- <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" checked />
                        <label for="check-male">male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" />
                        <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-other" name="gender" />
                        <label for="check-other">prefer not to say</label>
                    </div>
                </div>
            </div> -->
            <!-- <div class="input-box address">
                <label>Address</label>
                <input type="text" placeholder="Enter street address" required />
                <input type="text" placeholder="Enter street address line 2" required />
                <div class="column">
                    <div class="select-box">
                        <select>
                            <option hidden>Country</option>
                            <option>America</option>
                            <option>Japan</option>
                            <option>India</option>
                            <option>Nepal</option>
                        </select>
                    </div>
                    <input type="text" placeholder="Enter your city" required />
                </div>
                <div class="column">
                    <input type="text" placeholder="Enter your region" required />
                    <input type="number" placeholder="Enter postal code" required />
                </div>
            </div> -->
            <button id="btn-submit" onclick="userSignup()" type="button">สมัคร</button>
            <div class="d-flex flex-row justify-content-center my-3">
                <a href="/RoomBook/login_user.php" class="btn btn-primary">กลับ</a>
            </div>
        </form>

    </section>

    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        const userSignup = () => {
            const data = {
                u_FirstName: $("#u_FirstName").val(),
                u_LastName: $("#u_LastName").val(),
                u_Username: $("#u_Username").val(),
                u_PasswordHash: $("#u_PasswordHash").val(),
                u_Phone: $("#u_Phone").val(),
                u_Faculty: $("#u_Faculty").val(),
                u_Position: $("#u_Position").val()
            }
            $.ajax({
                url: '/RoomBook/backend/service/api_userSignup.php',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: res.message,
                            didClose: () => {
                                window.location.replace('/RoomBook/login_user.php')
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไม่สำเร็จ',
                            text: res.message
                        });
                    }
                }
            });
        }
    </script>
</body>

</html>