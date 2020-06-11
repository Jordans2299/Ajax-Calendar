<?php
require 'databaseHandler.php';


header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json
session_start();
// php://input recieves raw post data
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

$user_id = $json_obj['user_id'];


$sql = "SELECT * FROM events WHERE `user_id`=$user_id ORDER BY `time` ASC";
$result = mysqli_query($mysqliConn,$sql);
if($result){
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(array(
        "success" => true,
        "events" => $events
    ));
    exit;
}
else{
    echo json_encode(array(
        "success" => false,
        "message" => 'SQL Error'
    ));
    exit;
}


?>