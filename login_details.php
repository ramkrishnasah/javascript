<?php
include("connection.php");

if (isset($_POST['save'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "select * from user where email='$email' and password='$pass'";

    $res = mysqli_query($conn, $sql);


    $row = mysqli_fetch_array($res);

    if (is_array($row)) {
        echo "User found";
    } else {
        echo "Invalid Email/Password";
    }
    mysqli_close($conn);
}
?>