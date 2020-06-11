<?php 
session_start();

require "databaseHandler.php";

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

if(isset($_SESSION['username'])){
    echo json_encode(array(
        "success" => true,
        "username"=>$_SESSION['username'],
        "user_id" => $_SESSION['user_id']
    ));
    exit;
}
else{
    echo json_encode(array(
        "success" => false
	));
	exit;
}
?>