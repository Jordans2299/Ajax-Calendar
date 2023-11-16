<?php
require 'databaseHandler.php';

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json
session_start();
// php://input receives raw post data
$json_str = file_get_contents('php://input');
//This will store the data in an associative array
$json_obj = json_decode($json_str, true);

$event_id = $json_obj['event_id'];

$sql = "DELETE FROM events WHERE id=$event_id";
if(mysqli_query($mysqliConn,$sql)){
    echo json_encode(array(
        "success" => true
    ));
    exit;
}
else{
    echo json_encode(array(
        "success" => false,
        'message' => 'SQL error'
    ));
    exit;
}



?>
