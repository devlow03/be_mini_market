<?php
class Product
{
    public function addProduct($conn, $post)
    {
        try {
            $productName = $post['product_name'];
            $price = floatval($post['price']);
            $manufacturerId = intval($post['manufacturer_id']);
            $categoryId = intval($post['category_id']);
            $thumbnailUrl = $post['thumbnail_url'];
            $productionDate =date('Y-m-d', strtotime($post['production_date']));
            $expirationDate = date('Y-m-d', strtotime($post['expiration_date']));
            $currentTimestamp = date("Y-m-d H:i:s");
            
            $response = mysqli_query($conn, "SELECT * FROM `products` WHERE `product_name` = '$productName'");
            if (mysqli_num_rows($response) > 0) {
                echo json_encode(array("message" => "Sản phẩm đã tồn tại trên hệ thống"), JSON_UNESCAPED_UNICODE);
            } else {
                $query = "INSERT INTO `products` (`id`, `product_name`, `price`, `manufacturer_id`,
                 `category_id`, `thumbnail_url`, `production_date`, `expiration_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`)
                  VALUES (NULL, '$productName','$price' , '$manufacturerId', '$categoryId', '$thumbnailUrl', '$productionDate', '$expirationDate', b'1', '$currentTimestamp', NULL, NULL)";

                $request = mysqli_query($conn, $query);
                if ($request) {
                    echo json_encode(array("message" => "Thêm sản phẩm thành công"), JSON_UNESCAPED_UNICODE);
                } else {
                    http_response_code(400);
                    echo json_encode(array("message" => "Thêm sản phẩm thất bại"), JSON_UNESCAPED_UNICODE);
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getProduct($conn)
    {
        $query = "SELECT products.id,product_name,price,thumbnail_url,category_id,categories.category_name,manufacturer_id,manufacturer_name,production_date,expiration_date,
        products.is_active,products.created_at,products.updated_at,products.deleted_at
        FROM products
        INNER JOIN categories on products.category_id = categories.id
        INNER JOIN manufacturers on products.manufacturer_id = manufacturers.id
        WHERE products.is_active=1";
        $response = mysqli_query($conn, $query);

        if (mysqli_num_rows($response) > 0) {
            while ($row = mysqli_fetch_array($response)) {
                $data[] = $row;
            }
            echo json_encode([
                
                "data" => $data
            ], JSON_UNESCAPED_UNICODE);
        }
    }

    public function getProductById($conn,$get)
    {
       try{
        $id = $get["id"];
        $query = "SELECT products.id,product_name,price,thumbnail_url,category_id,categories.category_name,manufacturer_id,manufacturer_name,production_date,expiration_date,
        products.is_active,products.created_at,products.updated_at,products.deleted_at
        FROM products
        INNER JOIN categories on products.category_id = categories.id
        INNER JOIN manufacturers on products.manufacturer_id = manufacturers.id
        WHERE products.is_active=1 and products.id = $id";
        $response = mysqli_query($conn, $query);

        if (mysqli_num_rows($response) > 0) {
            while ($row = mysqli_fetch_array($response)) {
                $data[] = $row;
            }
            echo json_encode([
                
                "data" => $data
            ], JSON_UNESCAPED_UNICODE);
        }
       }catch(Exception $e){
        echo $e;
       }
    }

    public function editProduct($conn, $post)
    {
        try {
            $id = $post['id'];
            $productName = $post['product_name'];
            $price = floatval($post['price']);
            $manufacturerId = intval($post['manufacturer_id']);
            $categoryId = intval($post['category_id']);
            $thumbnailUrl = $post['thumbnail_url'];
            $productionDate =date('Y-m-d', strtotime($post['production_date']));
            $expirationDate = date('Y-m-d', strtotime($post['expiration_date']));
            $currentTimestamp = date("Y-m-d H:i:s");
            $query = "UPDATE `products` SET `product_name` = '$productName',`price`='$price',`manufacturer_id`='$manufacturerId',`category_id`='$categoryId',
            `thumbnail_url`='$thumbnailUrl',`production_date`='$productionDate',`expiration_date`='$expirationDate',`updated_at`='$currentTimestamp'
             WHERE `products`.`id` = '$id'";
            $request = mysqli_query($conn, $query);
            if ($request) {
                echo json_encode(array("message" => "Cập nhật sản phẩm thành công"), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array("message" => "Cập nhật sản phẩm  thất bại"), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteProduct($conn, $post)
    {
        try {
            $id = $post['id'];
            $currentTimestamp = date("Y-m-d H:i:s");
            $query = "UPDATE `products` SET `is_active`=0, `deleted_at`='$currentTimestamp' WHERE  `id`='$id'";
            $request = mysqli_query($conn, $query);
            if ($request) {
                echo json_encode(array("message" => "Xóa sản phẩm thành công"), JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(array("message" => "Xóa sản phẩm thất bại"), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
