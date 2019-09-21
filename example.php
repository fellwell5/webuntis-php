<?php


    require "webuntis.php";

    $untis = new Webuntis();
    
    #auth('url', 'schoolname', 'username', 'password');
    $untis->auth('arche.webuntis.com', 'litec', '40146720140010', '_passwort_');
    
    $table      = $untis->getTimetable();
    $subjects   = $untis->getSubjects();
    $teachers   = $untis->getTeachers();
    $rooms      = $untis->getRooms();
    $holidays   = $untis->getHolidays();
    $statusdata = $untis->getStatusData();

    print_r($table);
    print_r($subjects);
    $untis->logout();
?>
