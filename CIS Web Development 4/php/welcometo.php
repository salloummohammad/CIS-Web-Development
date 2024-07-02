<?php
if(isset($_POST["submit"])){
    $pn=$_POST["pname"];
    $pr = $_POST["price"];
    $q = $_POST["qty"];
    $cl = $_POST["color"];

    $link = mysqli_connect("localhost", "root", "", "supermarket1");

    $sql = "INSERT INTO product(pro_name, price, qty, color) VALUES($pn, $pr, $q, $cl)";

    if(mysqli_query($link, $sql)){
        echo "Record inserted successfully!";
    }else{
        echo "Something went wrong!";
    }
}
echo "helo world"
?>