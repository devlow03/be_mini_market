<?php
require_once 'controllers/product.php';
require_once 'controllers/user.php';
require_once 'controllers/category.php';
require_once 'controllers/manufacturer.php';
class Handlers
{
    private static $instance;
    private $product;
    private $user;
    private $category;
    private $manufacturer;

    public function __construct()
    {
        // $this->product = new Product();
        $this->user = new User();
        $this->category = new Category();
        $this->manufacturer = new Manufacturer();
        $this->product = new Product();
    }


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Handlers();
        }
        return self::$instance;
    }


    public function signIn($conn, $post)
    {
        return $this->user->signIn($conn, $post);
    }


    public function register($conn, $post)
    {
        return $this->user->register($conn, $post);
    }


    public function addCategory($conn, $post)
    {
        return $this->category->addCategory($conn, $post);
    }


    public function getCategory($conn)
    {
        return $this->category->getCategory($conn);
    }


    public function editCategory($conn, $post)
    {
        return $this->category->editCategory($conn, $post);
    }


    public function deleteCategory($conn, $post)
    {
        return $this->category->deleteCategory($conn, $post);
    }


    public function addManufacturer($conn, $post)
    {
        return $this->manufacturer->addManufacturer($conn, $post);
    }


    public function getManufacturer($conn)
    {
        return $this->manufacturer->getManufacturer($conn);
    }


    public function editManufacturer($conn, $post)
    {
        return $this->manufacturer->editManufacturer($conn, $post);
    }


    public function deleteManufacturer($conn, $post)
    {
        return $this->manufacturer->deleteManufacturer($conn, $post);
    }


    public function addProduct($conn, $post)
    {
        return $this->product->addProduct($conn, $post);
    }


    public function getProduct($conn)
    {
        return $this->product->getProduct($conn);
    }


    public function getProductById($conn,$get){
        return $this->product->getProductById($conn,$get);
    }

    public function editProduct($conn, $post){
        return $this->product->editProduct($conn, $post);
    }

    public function deleteProduct($conn, $post){
        return $this->product->deleteProduct($conn, $post);
    }
}
