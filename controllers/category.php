<?php

class Category
{
    public function addCategory($conn, $post)
    {
        try {
            $categoryName = $post['category_name'];
            $currentTimestamp = date("Y-m-d H:i:s"); // Lấy timestamp của thời gian hiện tại (số giây kể từ 1/1/1970)

            $response = mysqli_query($conn, "SELECT * FROM `categories` WHERE `category_name` = '$categoryName'");
            if (mysqli_num_rows($response) > 0) {
                echo json_encode(array("message" => "Sản phẩm đã tồn tại trên hệ thống"), JSON_UNESCAPED_UNICODE);
            } else {
                $query = "INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '$categoryName', '$currentTimestamp', NULL, NULL)";

                $request = mysqli_query($conn, $query);
                if ($request) {
                    echo json_encode(array("message" => "Thêm loại sản phẩm thành công"), JSON_UNESCAPED_UNICODE);
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Thêm loại sản phẩm thất bại"), JSON_UNESCAPED_UNICODE);
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getCategory($conn)
    {
        $response = mysqli_query($conn, "SELECT * FROM categories WHERE `is_active`=1");

        if (mysqli_num_rows($response) > 0) {
            while ($row = mysqli_fetch_array($response)) {
                $data[] = $row;
            }
            echo json_encode([
                
                "data" => $data
            ], JSON_UNESCAPED_UNICODE);
        }
    }

    public function editCategory($conn, $post)
    {
        $id = $post['id'];
        $categoryName = $post["category_name"];
        $currentTimestamp = date("Y-m-d H:i:s");
        $query = "UPDATE `categories` SET `category_name`='$categoryName', `updated_at`='$currentTimestamp' WHERE  `id`='$id'";
        $request = mysqli_query($conn, $query);
        if ($request) {
            echo json_encode(array("message" => "Cập nhật loại sản phẩm thành công"), JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(array("message" => "Cập nhật loại sản phẩm thất bại"), JSON_UNESCAPED_UNICODE);
        }
    }

    public function deleteCategory($conn, $post)
    {
        try {
            $id = $post['id'];
            $currentTimestamp = date("Y-m-d H:i:s");
            $query = "UPDATE `categories` SET `is_active`=0, `deleted_at`='$currentTimestamp' WHERE  `id`='$id'";
            $request = mysqli_query($conn, $query);
            if ($request) {
                echo json_encode(array("message" => "Xóa loại sản phẩm thành công"), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array("message" => "Xóa loại sản phẩm thất bại"), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
