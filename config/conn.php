<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

$host="localhost";
$user="root";
$pass="";
$db="mini_market";
$conn = mysqli_connect($host,$user,$pass,$db);
mysqli_query($conn,"set names utf8");



// if($conn){
//     echo "Kết nối thành công";
// }
// else{
//     echo "Thát bại";
// }

?>