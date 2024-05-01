<?php

use FFI\Exception;

class Manufacturer
{
    public function addManufacturer($conn, $post)
    {
        try{
        $name = $post['name'];
        $currentTimestamp = date("Y-m-d H:i:s"); 
    
        $response = mysqli_query($conn, "SELECT * FROM `manufacturers` WHERE `manufacturer_name` = '$name'");
        if (mysqli_num_rows($response) > 0) {
            echo json_encode(array("message" => "Nhà sản xuất đã tồn tại trên hệ thống"), JSON_UNESCAPED_UNICODE);
        } else {
            $query = "INSERT INTO `manufacturers` (`id`, `manufacturer_name`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, '$name', '$currentTimestamp', NULL, NULL)";

            $request = mysqli_query($conn, $query);
            if ($request) {
                echo json_encode(array("message" => "Thêm nhà sản xuất thành công"), JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(400);
                echo json_encode(array("message" => "Thêm nhà sản xuất thất bại"), JSON_UNESCAPED_UNICODE);
            }
        }
        }catch(Exception $e){
            echo $e;
        }
    }

    public function getManufacturer($conn){
        $response = mysqli_query($conn, "SELECT * FROM manufacturers WHERE `is_active`=1");
        
        if(mysqli_num_rows($response)>0){
            while($row = mysqli_fetch_array($response)){
                $data[] = $row;
                
            }
            echo json_encode([
               
                "data"=>$data
            ],JSON_UNESCAPED_UNICODE);
           
        }
    }

    public function editManufacturer($conn, $post){
        try{
        $id = $post['id'];
        $name=$post["name"];
        $currentTimestamp = date("Y-m-d H:i:s"); 
        $query = "UPDATE `manufacturers` SET `manufacturer_name`='$name', `updated_at`='$currentTimestamp' WHERE  `id`='$id'";
        $request = mysqli_query($conn,$query);
        if($request){
            echo json_encode(array("message" => "Cập nhật nhà sản xuất thành công"), JSON_UNESCAPED_UNICODE);
        }
        else{
            echo json_encode(array("message" => "Cập nhật nhà sản xuất thất bại"), JSON_UNESCAPED_UNICODE);
        }
        }catch(Exception $e){
            echo $e;
        }
        
        
    }

    public function deleteManufacturer($conn,$post){
        try{
        $id = $post['id'];
        $currentTimestamp = date("Y-m-d H:i:s");
        $query = "UPDATE `manufacturers` SET `is_active`=0, `deleted_at`='$currentTimestamp' WHERE  `id`='$id'";
        $request = mysqli_query($conn,$query);
        if($request){
            echo json_encode(array("message" => "Xóa nhà sản xuất thành công"), JSON_UNESCAPED_UNICODE);
        }
        else{
            echo json_encode(array("message" => "Xóa nhà sản xuất thất bại"), JSON_UNESCAPED_UNICODE);   
        }
        }catch(Exception $e){
            echo $e;
        }
        
    }
    
}
