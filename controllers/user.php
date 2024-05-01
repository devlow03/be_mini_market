<?php

class User
{
    public  function register($conn, $post)
    {
        $fullName = $post['full_name'];
        $userName = $post['user_name'];
        $password = password_hash($post['password'], PASSWORD_BCRYPT);
        $response = mysqli_query($conn, "SELECT * FROM `users` WHERE `user_name` = '$userName'");
        if (mysqli_num_rows($response) > 0) {
            echo json_encode(array("message" => "Tài khoản đã tồn tại trên hệ thống"), JSON_UNESCAPED_UNICODE);
        } else {
            $query = "INSERT INTO `users` (`full_name`, `user_name`, `password`) VALUES ('$fullName', '$userName', '$password')";
            $request = mysqli_query($conn, $query);
            if ($request) {
                echo json_encode(array("message" => "Đăng kí tài khoản thành công"), JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(400); 
                echo json_encode(array("message" => "Đăng kí tài khoản thất bại"), JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public  function signIn($conn, $post)
    {
        $userName = $post['user_name'];
        $password = $post['password'];
        $query = ("SELECT * FROM `mini_market`.`users` WHERE `user_name` = '$userName'");
        $request = mysqli_query($conn, $query);
        if (mysqli_num_rows($request) > 0) {
            $data[] = mysqli_fetch_array($request);
            $hashpass = $data[0]['password'];
            $userId = $data[0]['user_id'];
            if ($hashpass !== null && password_verify($password, $hashpass)) {
                
                $session_id = bin2hex(openssl_random_pseudo_bytes(16));

               
                session_start();

                

                $_SESSION['session_id'] = $session_id;
                echo json_encode(array(
                    "message" => "Đăng nhập thành công",
                    "session_id" => $session_id
                ), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array("message" => "Tài khoản hoặc mật khẩu không đúng"), JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(400); 
            echo json_encode(array("message" => "Đăng nhập thất bại"), JSON_UNESCAPED_UNICODE);
        }
    }
}
