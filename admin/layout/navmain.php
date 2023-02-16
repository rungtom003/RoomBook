<!-- start: Navbar -->
<nav class="px-3 py-2 bg-white rounded shadow">
    <i class="ri-menu-line sidebar-toggle me-3 d-block d-md-none"></i>
    <h5 class="fw-bold mb-0 me-auto" style="font-family: kanit-Regular;"><?= $titleHead ?></h5>
    <div class="dropdown me-3 d-none d-sm-block">
    </div>
    <div class="dropdown">
        <div class="d-flex align-items-center cursor-pointer dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="me-2 d-none d-sm-block" style="font-family: kanit-Regular;"><?php echo isset($user["u_FirstName"]) ? $user["u_FirstName"] : "" ?> <?php echo isset($user["u_LastName"]) ? $user["u_LastName"] : "" ?></span>
            <img class="navbar-profile-image" src="/ReserveSpace/src/img/user.jpg" alt="Image">
        </div>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" style="font-family: kanit-Regular;" href="#">ข้อมูลส่วนตัว</a></li>
            <li><a class="dropdown-item" style="font-family: kanit-Regular;" href="/RoomBook/backend/service/api_logout.php">ออกจากระบบ</a></li>
        </ul>
    </div>
</nav>
<!-- end: Navbar -->
<script>
</script>