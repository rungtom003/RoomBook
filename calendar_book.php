<?php
// session_start();
// $user = (isset($_SESSION['user'])) ? unserialize($_SESSION['user']) : null;
// if($user == null){
//     header('location: /ReserveSpace/login.php');
// }
$titleHead = "ปฏิทินการจอง";
$active_calendar_book = "active";
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
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            <!-- end: Content -->
        </div>
    </main>
    <!-- end: Main -->
    <?php include("./layout/script.php"); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th',
                //height: '100%',
                themeSystem: 'bootstrap5',
                expandRows: true,
                // slotMinTime: '00:00',
                // slotMaxTime: '23:00',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                initialDate: '2023-01-12',
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: 'https://fullcalendar.io/api/demo-feeds/events.json'
            });
            calendar.render();
        });
    </script>
</body>

</html>