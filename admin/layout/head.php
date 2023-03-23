<!-- start: Sidebar -->
<div class="sidebar position-fixed top-0 bottom-0 bg-white border-end">
    <div class="d-flex align-items-center p-3">
        <a href="#" class="sidebar-logo text-uppercase fw-bold text-decoration-none text-indigo fs-4">ระบบจองห้อง</a>
        <i class="sidebar-toggle ri-arrow-left-circle-line ms-auto fs-5 d-none d-md-block"></i>
    </div>
    <ul class="sidebar-menu p-3 m-0 mb-0">
        <li class="sidebar-menu-item <?= isset($active_index) ? $active_index : "" ?>">
            <a href="/RoomBook/admin/index.php">
                <i class="ri-home-5-line sidebar-menu-item-icon"></i>
                หน้าเเรก
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_classroom_timetable) ? $active_classroom_timetable : "" ?>">
            <a href="/RoomBook/admin/classroom_timetable.php">
                <i class="ri-draft-line sidebar-menu-item-icon"></i>
                จัดการตารางสอน
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_calendar_book) ? $active_calendar_book : "" ?>">
            <a href="/RoomBook/admin/calendar_book.php">
                <i class="ri-calendar-todo-line sidebar-menu-item-icon"></i>
                ปฏิทินการจอง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_tablebook) ? $active_tablebook : "" ?>">
            <a href="/RoomBook/admin/table_book.php">
                <i class="ri-table-line sidebar-menu-item-icon"></i>
                ตารางจองห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_dataBookRoom) ? $active_dataBookRoom : "" ?>">
            <a href="/RoomBook/admin/book_list.php">
                <i class="ri-delete-bin-line sidebar-menu-item-icon"></i>
                ลบข้อมูลการจอง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_building) ? $active_building : "" ?>">
            <a href="/RoomBook/admin/building.php">
                <i class="ri-community-line sidebar-menu-item-icon"></i>
                อาคาร
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_room) ? $active_room : "" ?>">
            <a href="/RoomBook/admin/room.php">
                <i class="ri-home-7-line sidebar-menu-item-icon"></i>
                ห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_roomType) ? $active_roomType : "" ?>">
            <a href="/RoomBook/admin/roomType.php">
                <i class="ri-building-2-line sidebar-menu-item-icon"></i>
                ประเภทห้อง
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_user) ? $active_user : "" ?>">
            <a href="/RoomBook/admin/user.php">
                <i class="ri-user-follow-line sidebar-menu-item-icon"></i>
                สมาชิก
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($signup_admin) ? $signup_admin : "" ?>">
            <a href="/RoomBook/admin/signup_admin.php">
                <i class="ri-user-add-line sidebar-menu-item-icon"></i>
                สมัครสมาชิก
            </a>
        </li>
        <li class="sidebar-menu-item <?= isset($active_manage_img) ? $active_manage_img : "" ?>">
            <a href="/RoomBook/admin/manage_img.php">
                <i class="ri-image-edit-line sidebar-menu-item-icon"></i>
                จัดการรูปหน้าเเรก
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-overlay"></div>
<!-- end: Sidebar -->