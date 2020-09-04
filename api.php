<?php
    // https://huang2387.pixnet.net/blog/post/301541795-%E3%80%90%E7%B6%93%E9%A9%97%E3%80%91php-%E6%AA%94%E6%A1%88%E4%B8%8A%E5%82%B3-%E6%AD%A5%E9%A9%9F%E6%95%99%E5%AD%B8
    // var_dump($_POST);
    // var_dump($_FILES);
    // move_uploaded_file($_FILES["productPicture"]["tmp_name"], "img/pic1.jpg");

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
        $row = mysqli_fetch_assoc($result);
        if($rowNum == 0) {
            $sqlCommand = <<< multi
                INSERT INTO users(userName, userPassword, email, birthday, gender, userType)
                VALUE ('$userName', '$userPassword', '$email', '$birthday', '$gender', 1)
            multi;
            mysqli_query($dbLink, $sqlCommand);
            echo '{"errorCode": 666}';            
        }
        else{
            echo '{"errorCode": 1}';            
        }
    }
?>