<?php
    session_start();
    $dbLink = mysqli_connect("localhost", "root", "root", "PID_Assignment", 8889) or die(mysqli_connect_error());
    // $dbLink = mysqli_connect("localhost", "root", "", "PID_Assignment") or die(mysqli_connect_error());
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
                if($row["userStatus"] == 2) {
                    echo '{"errorCode": 3}';
                    return;
                }
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
    else if(isset($_POST["getUserOrder"])) {
        $userName = $_SESSION["userName"];
        $sqlCommand = <<< multi
            SELECT * FROM orders WHERE userId = (SELECT userId FROM users WHERE userName = '$userName')
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum == 0) {
            echo '{"errorCode": 1}';
            return;
        }
        while($row = mysqli_fetch_assoc($result)) {
            $order[] = $row;
        }
        // var_dump($order);
        for($i = 0;$i < count($order); $i++) {
            $orderId = $order[$i]["orderId"];
            $sqlCommand = <<< multi
                SELECT od.orderId, p.productName, p.price, od.qty FROM orderDetails od JOIN products p ON od.productId = p.productId WHERE orderId = $orderId
            multi;
            $result = mysqli_query($dbLink, $sqlCommand);
            $orderDetail= array();
            while($row = mysqli_fetch_assoc($result)) {
                $orderDetail[] = $row;
            }
            $order[$i]["orderDetails"] = $orderDetail;            
        }
        // var_dump($order);
        $returnData["errorCode"] = 666;
        $returnData["orders"] = $order;
        echo json_encode($returnData);
    }
    else  if(isset($_POST["getUserOrderByAdmin"])){
        $userId = $_POST["userId"];
        $sqlCommand = <<< multi
            SELECT * FROM orders WHERE userId = $userId
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum == 0) {
            echo '{"errorCode": 1}';
            return;
        }
        while($row = mysqli_fetch_assoc($result)) {
            $order[] = $row;
        }
        // var_dump($order);
        for($i = 0;$i < count($order); $i++) {
            $orderId = $order[$i]["orderId"];
            $sqlCommand = <<< multi
                SELECT od.orderId, p.productName, p.price, od.qty FROM orderDetails od JOIN products p ON od.productId = p.productId WHERE orderId = $orderId
            multi;
            $result = mysqli_query($dbLink, $sqlCommand);
            $orderDetail= array();
            while($row = mysqli_fetch_assoc($result)) {
                $orderDetail[] = $row;
            }
            $order[$i]["orderDetails"] = $orderDetail;            
        }
        // var_dump($order);
        $returnData["errorCode"] = 666;
        $returnData["orders"] = $order;
        echo json_encode($returnData);        
    }
    else if(isset($_POST["getCart"])) {
        $userName = $_SESSION["userName"];
        $sqlCommand = <<< multi
            SELECT * FROM cart c JOIN products p ON c.productId = p.productId WHERE userId = (SELECT userId FROM users WHERE userName = '$userName')
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $cartItems = array();
        while($row = mysqli_fetch_assoc($result)) {
            $cartItems[] = $row;
        }
        echo json_encode($cartItems);
    }
    else if(isset($_POST["deleteCartProduct"])) {
        $userName = $_SESSION["userName"];
        $productId = $_POST["productId"];
        $sqlCommand = <<< multi
            DELETE FROM cart WHERE userId = (SELECT userId FROM users WHERE userName = '$userName') AND productId = $productId
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["qtyChange"])) {
        $userName = $_SESSION["userName"];
        $productId = $_POST["productId"];
        $qty = $_POST["qty"];
        $sqlCommand = <<< multi
            UPDATE cart SET qty = $qty WHERE productId = $productId AND userId = (SELECT userId FROM users WHERE userName = '$userName')
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["buyCartProduct"])) {
        // var_dump($_POST);
        $userName = $_SESSION["userName"];
        $sqlCommand = <<< multi
            SELECT * FROM cart WHERE userId = (SELECT userId FROM users WHERE userName = '$userName')
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum == 0) {
            echo '{"errorCode": 1}';
            return;
        }else {
            while($row = mysqli_fetch_assoc($result)) {
                $allProduct[] = $row;
            }
            for($i = 0;$i < count($allProduct); $i++) {
                $productId = $allProduct[$i]["productId"];
                $qty = $allProduct[$i]["qty"];
                $sqlCommand = "SELECT * FROM products WHERE productId = $productId";
                $result = mysqli_query($dbLink, $sqlCommand);
                $row = mysqli_fetch_assoc($result);
                if($qty > $row["inStock"]) {
                    $returnValue["errorCode"] = 2;
                    $returnValue["productName"] = $row["productName"];
                    echo json_encode($returnValue);
                    return;
                }
            }            
            $sqlCommand = <<< multi
                INSERT INTO orders(userId, shippingStatus) VALUES ((SELECT userId FROM users WHERE userName = '$userName'), 1);
                SELECT orderId FROM orders ORDER BY orderId DESC LIMIT 0,1;
            multi;
            mysqli_multi_query($dbLink, $sqlCommand);
            mysqli_next_result($dbLink);
            $result = mysqli_store_result($dbLink);
            $row = mysqli_fetch_assoc($result);
            $orderId = $row["orderId"];   
            $sqlCommand = "INSERT INTO orderDetails(orderId, productId, qty) VALUES";
            for($i = 0; $i < count($allProduct); $i++) {
                $productId = $allProduct[$i]["productId"];
                $qty = $allProduct[$i]["qty"];
                if($i != 0) {
                    $sqlCommand .= ', ';
                }
                $sqlCommand .= "($orderId, $productId, $qty)";                
            }
            $sqlCommand .= ";DELETE FROM cart WHERE userId = (SELECT userId FROM users WHERE userName = '$userName');";
            for($i = 0;$i < count($allProduct); $i++) {
                $productId = $allProduct[$i]["productId"];
                $qty = $allProduct[$i]["qty"];
                $sqlCommand .= "UPDATE products SET inStock = inStock - $qty WHERE productId = $productId;";
            }
            mysqli_multi_query($dbLink, $sqlCommand);
            echo '{"errorCode": 666}';
            mysqli_close($dbLink);
        }

    }
    else if(isset($_POST["deleteAllCart"])) {
        $userName = $_SESSION["userName"];
        $sqlCommand = <<< multi
            DELETE FROM cart WHERE userId = (SELECT userId FROM users WHERE userName = '$userName')
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["getProductData"])) {
        $sqlCommand = <<< multi
            SELECT * FROM products
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $allProducts[] = $row;
            }
            $returnValue["errorCode"] = 666;
            $returnValue["allProducts"] = $allProducts;
            echo json_encode($returnValue);
        } else {
            echo '{"errorCode": 1}';
        }
    }
    else if(isset($_POST["getOneProduct"])) {
        $productId = $_POST["productId"];
        $sqlCommand = <<< multi
            SELECT * FROM products WHERE productId = $productId
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }
    else if(isset($_POST["addIntoCart"])) {
        if(!isset($_SESSION["userName"])) {
            echo '{"errorCode": 1}';
            return;
        }
        $userName = $_SESSION["userName"];
        $productId = $_POST['productId'];
        $qty = $_POST['qty'];
        $sqlCommand = <<< multi
            SELECT * FROM cart WHERE productId = $productId AND userId = (SELECT userId FROM users WHERE userName = '$userName')
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum != 0) {
            echo '{"errorCode": 2}';
            return;
        }
        else {
            $sqlCommand = <<< multi
                INSERT INTO cart(userId, productId, qty) VALUES ((SELECT userId FROM users WHERE userName = '$userName'), $productId, $qty)
            multi;
            mysqli_query($dbLink, $sqlCommand);            
        }
        // echo json_encode()
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["getUserId"])) {
        $sqlCommand = <<< multi
            SELECT * FROM users;
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $rowNum = mysqli_num_rows($result);
        if($rowNum <= 0 ) {
            return;
        }
        else {
            while($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            $returnData["errorCode"] = 666;
            $returnData["users"] = $users;
            echo json_encode($returnData);
        }
    }
    else if(isset($_POST["userBan"])) {
        $userStatus = $_POST["userStatus"];
        $userId = $_POST["userId"];
        $sqlCommand = <<< multi
            UPDATE users SET userStatus = $userStatus WHERE userId = $userId
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["deleteProduct"])) {
        $productId = $_POST["productId"];
        $sqlCommand = <<< multi
            SELECT productPic FROM products WHERE productId = $productId
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $row = mysqli_fetch_assoc($result);
        $pictureName = $row["productPic"];
        unlink($pictureName);
        $sqlCommand = <<< multi
            DELETE FROM products WHERE productId = $productId
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["addProduct"])) {
        $productName = $_POST["productName"];
        $description = $_POST["description"];
        $productType = $_POST["productType"];
        $price = $_POST["price"];
        $inStock = $_POST["inStock"];
        $sqlCommand = <<< multi
            INSERT INTO products (productName, description, productType, price, inStock)
            VALUES ('$productName', '$description', $productType, $price, $inStock)
        multi;
        mysqli_query($dbLink, $sqlCommand);
        $sqlCommand = <<< multi
            SELECT productId FROM products ORDER BY productId DESC LIMIT 0,1
        multi;
        $result = mysqli_query($dbLink, $sqlCommand);
        $row = mysqli_fetch_assoc($result);
        $productId = $row["productId"];
        if($_FILES["productPicture"]["type"] == "image/jpeg") {
            move_uploaded_file($_FILES["productPicture"]["tmp_name"], "img/pic$productId.jpg");
            $sqlCommand = <<< multi
                UPDATE products SET productPic = 'img/pic$productId.jpg' WHERE productId = $productId
            multi;
        }
        else if($_FILES["productPicture"]["type"] == "image/png") {
            move_uploaded_file($_FILES["productPicture"]["tmp_name"], "img/pic$productId.png");
            $sqlCommand = <<< multi
                UPDATE products SET productPic = 'img/pic$productId.png' WHERE productId = $productId
            multi;
        }
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
    else if(isset($_POST["updateProduct"])) {
        $productId = $_POST["productId"];
        $productName = $_POST["productName"];
        $description = $_POST["description"];
        $productType = $_POST["productType"];
        $price = $_POST["price"];
        $inStock = $_POST["inStock"];
        if($_FILES["productPicture"]["type"] == "image/jpeg") {
            unlink("img/pic$productId.jpg");
            move_uploaded_file($_FILES["productPicture"]["tmp_name"], "img/pic$productId.jpg");
        }
        else if($_FILES["productPicture"]["type"] == "image/png") {
            unlink("img/pic$productId.png");            
            move_uploaded_file($_FILES["productPicture"]["tmp_name"], "img/pic$productId.png");
        }
        $sqlCommand = <<< multi
            UPDATE products SET productName = '$productName', description = '$description', productType = $productType, price = $price, inStock = $inStock WHERE productId = $productId
        multi;
        mysqli_query($dbLink, $sqlCommand);
        echo '{"errorCode": 666}';
    }
?>