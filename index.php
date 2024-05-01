<?php
require_once 'config/conn.php';
require_once 'handlers.php';
header('Content-Type: application/json');
$handle = Handlers::getInstance();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST)) {
       
       
        // $handle->register($conn, $_POST); //dang ki
        // $handle->signIn($conn, $_POST);
        // $handle->addCategory($conn, $_POST);
        // $handle->editCategory($conn,$_POST);
        // $handle->addManufacturer($conn,$_POST);
        // $handle->editManufacturer($conn,$_POST);
        // $handle->deleteManufacturer($conn,$_POST);
        // $handle->addProduct($conn,$_POST);
        // $handle->editProduct($conn,$_POST);
        $handle->deleteProduct($conn,$_POST);

        
    } else {
        http_response_code(400); // Dữ liệu không hợp lệ
        echo json_encode(array("message" => "Dữ liệu không được gửi."));
    }
}
    

if($_SERVER["REQUEST_METHOD"] == "GET"){
    
    //$handle->getCategory($conn);
    // $handle->deleteCategory($conn,$_GET);
    // $handle->getManufacturer($conn);
     $handle->getProduct($conn);
    // $handle->getProductById($conn,$_GET);
}
