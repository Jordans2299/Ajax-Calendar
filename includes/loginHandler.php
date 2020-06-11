<?php 

require "databaseHandler.php";

header("Content-Type: application/json"); // Since we are sending a JSON response here (not an HTML document), set the MIME Type to application/json

// php://input recieves raw post data
$json_str = file_get_contents('php://input');
//This will store the data into an associative array
$json_obj = json_decode($json_str, true);

    $userCred = $json_obj['username'];
    $password = $json_obj['password'];


    if(empty($userCred) || empty($password)){
        echo json_encode(array(
            "success" => false,
            "message" => "Empty Username or Password"
        ));
        exit;
    }
    else{
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($mysqliConn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo json_encode(array(
                "success" => false,
                "message" => "MySql error"
            ));
            exit;
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$userCred);
            mysqli_stmt_execute($stmt);
            $data = mysqli_stmt_get_result($stmt);
            #The selected row of the table is represented by an assciative array
            if($row = mysqli_fetch_assoc($data)){
                #checks to see if password matches, unhashes and rehashes
                $pwdCheck = password_verify($password, $row['password']);
                if($pwdCheck==false){
                    echo json_encode(array(
                        "success" => false,
                        "message" => "Wrong password"
                    ));
                    exit;
                }
                else if($pwdCheck==true){
                    session_start();
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['user_id'] = $row["user_id"];
                    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    
                    echo json_encode(array(
                        "success" => true,
                        "username"=>$userCred,
                        "user_id" => $_SESSION['user_id']
                    ));
                    exit;
                }
                else{
                    echo json_encode(array(
                        "success" => false,
                        "message" => "Wrong password"
                    ));
                    exit;
                }
            }
            else{
                echo json_encode(array(
                    "success" => false,
                    "message" => "Username doesn't exist"
                ));
                exit;
            }
        }
    }



// if(isset($_POST['login-submit'])){
//     require "databaseHandler.php";

//     $userCred = $_POST['username'];
//     $password = $_POST['pwd'];

//     if(empty($userCred) || empty($password)){
//         header("Location: ../index.php?error=emptyfields");
//         exit();
//     }
//     else{
//         $sql = "SELECT * FROM users WHERE username=?";
//         $stmt = mysqli_stmt_init($mysqliConn);
//         if(!mysqli_stmt_prepare($stmt, $sql)){
//             header("Location: ../index.php?error=sqlError");
//             exit();
//         }
//         else{
//             mysqli_stmt_bind_param($stmt,"s",$userCred);
//             mysqli_stmt_execute($stmt);
//             $data = mysqli_stmt_get_result($stmt);
//             #The selected row of the table is represented by an assciative array
//             if($row = mysqli_fetch_assoc($data)){
//                 #checks to see if password matches, unhashes and rehashes
//                 $pwdCheck = password_verify($password, $row['password']);
//                 if($pwdCheck==false){
//                     header("Location: ../index.php?error=wrongpassword");
//                     exit();
//                 }
//                 else if($pwdCheck==true){
//                     session_start();
//                     $_SESSION['username'] = $row["username"];
//                     $_SESSION['userId'] = $row["user_id"];
//                     $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    
//                     header("Location: ../index.php?LoginSuccess");
//                     exit();
//                 }
//                 else{
//                     header("Location: ../index.php?error=wrongpassword");
//                     exit();
//                 }
//             }
//             else{
//                 header("Location: ../index.php?error=noUsersMatch");
//                 exit();
//             }
//         }
//     }

// }
// else{
//     header("Location: ../index.php");
//     exit();
// }