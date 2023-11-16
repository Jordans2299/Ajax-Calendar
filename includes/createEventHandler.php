<?php
    require "databaseHandler.php";

    header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json
    session_start();
    // php://input receives raw post data
    $json_str = file_get_contents('php://input');
    //This will store the data in an associative array
    $json_obj = json_decode($json_str, true);

    $title = $json_obj['title'];
    $date = $json_obj['date'];
    $time = $json_obj['time'];
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE `user_id` ='$user_id'";
    $result = mysqli_query($mysqliConn,$sql);

    $user = mysqli_fetch_assoc($result);
    if(empty($title) || empty($date)|| empty($time)||empty($user_id)){
        echo json_encode(array(
            "success" => false,
            "message" => "Empty Fields title:".$title." user_id: ".$user_id." username: ".$_SESSION['username']
        ));
        exit;
    }
    else{
        $sql = "INSERT INTO events(`user_id`,`date`,`time`,`title`) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($mysqliConn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo json_encode(array(
                "success" => false,
                "message" => "SQL Error"
            ));
            exit;
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssss", $user_id,$date,$time,$title);
            //mysqli_stmt_execute($stmt);
            if(mysqli_stmt_execute($stmt)){
                echo json_encode(array(
                    "success" => true
                ));
                exit;
            }
            else{
                echo json_encode(array(
                    "success" => false,
                    "message" => "SQL Error"
                ));
                exit;
            }

        }
    }
    return;
