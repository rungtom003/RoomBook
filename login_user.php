<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "Home";
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
        max-width: 500px;
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
        <header>Login</header>
        <form class="form">
       

            <div class="input-box">
                <label>Username</label>
                <input type="text" placeholder="Username" id="u_Username" required />
            </div>

            <div class="input-box">
                <label>Password</label>
                <input type="password" placeholder="Password" id="u_PasswordHash" required />
            </div>

            <button onclick="userLogin()" type="button">Login</button>
        </form>
        <div class="signup my-3 d-flex justify-content-center">
        <span class="signup">Don't have an account?
         <a href="./signup_user.php">?????????????????????????????????</a>
        </span>
      </div>
    </section>

    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        const userLogin = () => {
            const data = {
                u_Username: $("#u_Username").val(),
                u_PasswordHash: $("#u_PasswordHash").val()
            }
            $.ajax({
                url: '/RoomBook/backend/service/api_userLogin.php',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(res) {
                    //console.log(res);
                    if (res.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: '??????????????????',
                            text: res.message,
                            didClose:()=>{
                               window.location.replace('/RoomBook/index.php')
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: '???????????????????????????',
                            text: res.message
                        });
                    }
                }
            });
        }
    </script>
    
</body>

</html>