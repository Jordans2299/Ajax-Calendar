<?php

// Content of database.php

$mysqliConn = mysqli_connect('localhost', 'wustl_inst', '12345', 'myCalendar');

if (!$mysqliConn){
    die("Could not connect to database: ".mysqli_connect_error());
}


?>