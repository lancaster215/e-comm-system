<?php
session_start();
include_once "../../php/includes/db_include.php";
$q = $_POST['q'];

mysqli_select_db($conn,"ecom");
$sql = "SELECT product_cat FROM products";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
     $data[] = $row['product_cat'];
}
$hint="";

if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    $name=$data;
    foreach($data as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}
echo $hint === "" ? "no suggestion" : $hint;

mysqli_close($conn);
?>