<?php
    // https://huang2387.pixnet.net/blog/post/301541795-%E3%80%90%E7%B6%93%E9%A9%97%E3%80%91php-%E6%AA%94%E6%A1%88%E4%B8%8A%E5%82%B3-%E6%AD%A5%E9%A9%9F%E6%95%99%E5%AD%B8
    // var_dump($_POST);
    // var_dump($_FILES);
    // move_uploaded_file($_FILES["productPicture"]["tmp_name"], "img/pic1.jpg");

    session_start();
    $dbLink = mysqli_connect("localhost", "root", "root", "PID_Assignment", 8889) or die(mysqli_connect_error());
    mysqli_query($dbLink, "set names utf8");

    if(isset($_POST["signupButton"])) {
        $userName = $_POST["userName"];
        $userPassword = $_POST["userPassword"];
        $email = $_POST["email"];
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"];
        $sqlCommand = <<< multi
            SELECT * FROM users WHERE userName = '$userName'
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum == 0) {
            $sqlCommand = <<< multi
                INSERT INTO users(userName, userPassword, email, birthday, gender, userType, userStatus)
                VALUE ('$userName', '$userPassword', '$email', '$birthday', '$gender', 1, 1)
            multi;
            mysqli_query($dbLink, $sqlCommand);
            echo '{"errorCode": 666}';            
        }
        else{
            echo '{"errorCode": 1}';            
        }
    }
    else if(isset($_POST["loginButton"])) {
        // var_dump($_POST);
        $userName = $_POST["userName"];
        $userPassword = $_POST["userPassword"];
        $sqlCommand = <<< multi
            SELECT * FROM users WHERE userName = '$userName'
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum == 0) {
            echo '{"errorCode": 1}';
        } else {
            $row = mysqli_fetch_assoc($result);
            // var_dump($row);
            if($userPassword == $row["userPassword"]) {
                $_SESSION["userName"] = $userName;
                $_SESSION["userType"] = $row["userType"];
                echo '{"errorCode": 666}';
            }
            else {
                echo '{"errorCode": 2}';
            }
        }
    }
    else if(isset($_POST["getUserInfo"])){
        $userName = $_SESSION["userName"];
        $sqlCommand = <<< multi
            SELECT * FROM users WHERE userName = '$userName'
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }
    else if(isset($_POST["updateUserInfo"])) {
        $userName = $_SESSION["userName"];
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $city = $_POST["city"];
        $address = $_POST["address"];
        $sqlCommand = <<< multi
            UPDATE users SET name = '$name', phone = '$phone', city = '$city', address = '$address' WHERE userName = '$userName'
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["updatePassword"])) {
        $userName = $_SESSION["userName"];
        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $sqlCommand = <<< multi
            SELECT userPassword FROM users WHERE userName = '$userName'
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $row = mysqli_fetch_assoc($result);
        if($oldPassword != $row["userPassword"]) {
            echo '{"errorCode": 1}';
        } else {
            $sqlCommand = <<< multi
                UPDATE users SET userPassword = '$newPassword' WHERE userName = '$userName'
            multi;
            mysqli_query($dbLink, $sqlCommand);
            echo '{"errorCode": 666}';
        }
    }
?>