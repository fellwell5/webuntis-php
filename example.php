<?php


    require "webuntis.php";

    $untis = new Webuntis();
    
    #auth('url', 'schoolname', 'username', 'password');
    $untis->auth('server.webuntis.com', 'schoolname', 'username', 'password');
    
    $table      = $untis->getTimetable();
    $subjects   = $untis->getSubjects();
    $teachers   = $untis->getTeachers();
    $rooms      = $untis->getRooms();
    $holidays   = $untis->getHolidays();
    $currentSchoolyear = $untis->getCurrentSchoolyear();
    $getSubstitutions = $untis->getSubstitutions(20201110,20201111); #Get all Substitutions from 10.11.2020 to 11.11.2020
    $untis->logout();
?>
