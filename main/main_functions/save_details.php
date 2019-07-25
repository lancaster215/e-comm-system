<?php
require_once '../../php/includes/db_include.php';
session_start();
if(isset($_POST['submit_cus'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['num'];
    $odid = $_POST['odid'];
    $pid = $_POST['pid'];
    $uid = $_SESSION['u_id'];

$sql = "INSERT INTO delivery(delivery_id, user_id, name, email, address, phone_number) VALUES('', '$uid', '$name', '$email', '$address', '$number')";
$run = mysqli_query($conn, $sql);

$sql4 = "UPDATE orders SET order_status='ongoing' WHERE user_id='$uid' AND order_status='on-sale'";
$result = mysqli_query($conn, $sql4);

$sql1 = "UPDATE order_details SET bought=0 WHERE order_details_id='$odid' AND product_id='$pid'";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "DELETE FROM cart WHERE user_id='$uid'";
$result2 = mysqli_query($conn, $sql2);

if($run)
    {
        echo '<script>
            alert("Record Saved!");
            window.location.href="../home.php";
        </script>';
        exit();
     }
    else
    {
        echo '<script>
            alert("Cannot save customer record!");
            window.location.href="../home.php";
        </script>';
        exit();
    }
}
?>

