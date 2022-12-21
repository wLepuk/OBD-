<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["customer_name"]) && isset($_POST["customer_email"])) {   
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $customername = mysqli_real_escape_string($conn, $_POST["customer_name"]);
    $phonenumber = mysqli_real_escape_string($conn, $_POST["customer_email"]);
    $sql = "INSERT INTO customer (customer_name, customer_email) VALUES ('$customername', '$customeremail')";
        if(mysqli_query($conn, $sql)){
            header("Location: customer.php");
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>