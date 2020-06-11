<?php

//This page soley handles the create of a new user
require 'databaseHandler.php';
// php://input recieves raw post data
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

$username = $json_obj['username'];
$password = $json_obj['password'];
$passwordRepeat = $json_obj['passwordRepeat'];

if(empty($username)|| empty($password)|| empty($passwordRepeat)){
    echo json_encode(array(
        "success" => false,
        "message" => "Empty Fields"
    ));
    exit;
}
else if($password != $passwordRepeat){
    echo json_encode(array(
        "success" => false,
        "message" => "Passwords do not match"
    ));
    exit;
}
else{
    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = mysqli_stmt_init($mysqliConn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo json_encode(array(
            "success" => false,
            "message" => "sql username error"
        ));
        exit;
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck>0){
            echo json_encode(array(
                "success" => false,
                "message" => "Username has been taken"
            ));
            exit;
        }
        else{
            $sql = "INSERT INTO users(username,password) VALUES (?,?)";
            $stmt = mysqli_stmt_init($mysqliConn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo json_encode(array(
                    "success" => false,
                    "message" => "Username or Password error"
                ));
                exit;
            }
            else{
                $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $username,$hashedPassword);
                mysqli_stmt_execute($stmt);
                $stmt = "SELECT * FROM users WHERE username='$username'";
                $data = mysqli_query($mysqliConn,$stmt);
                if($row = mysqli_fetch_assoc($data)){
                    session_start();
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['user_id'] = $row["user_id"];
                    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    echo json_encode(array(
                        "success" => true,
                        "username" => $username, 
                        "user_id" => $_SESSION['user_id']
                    ));
                    exit;
                }
                else{
                    echo json_encode(array(
                        "success" => false,
                        "message" => "couldn't get username and user_id"
                    ));
                    exit;
                }
            }
        }
    }
}
mysqli_stmt_close($stmt);
mysqli_close($mysqliConn);

?>