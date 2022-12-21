<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
include "connect.php";
if (!$conn) {
    die("Помилка: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/base.css">
<?php include("font.php"); ?>
<title>updating...</title>
<meta charset="utf-8" />
</head>
<body>
<div class="divbg">
        <div class="regform">
<?php
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
{
    $customerid = mysqli_real_escape_string($conn, $_GET["id"]);
    $sql = "SELECT * FROM usertbl WHERE id = '$customerid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $customername = $row["full_name"];
            }
            echo "<h2>Оновлення даних користувачів</h2>
                <form method='post'>
                    <input type='hidden' name='id' value='$customerid' />
                    <p>ПІБ:</p>
                    <p><input type='text' name='customer_name' value='$customername' /></p>
                    <p>Пошта:</p>
                    <p><input type='text' name='customer_email' value='$customeremail' /></p>
                    <p><input type='submit' class='button' value='Зберегти'></p>
            </form>";
        }
        else{
            echo "<div>Користувача не знайдено</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["customer_id"]) && isset($_POST["customer_name"])) {
      
    $customerid = mysqli_real_escape_string($conn, $_POST["customer_id"]);
    $customername = mysqli_real_escape_string($conn, $_POST["customer_name"]);
    $customeremail = mysqli_real_escape_string($conn, $_POST["customer_email"]);
      
    $sql = "UPDATE usertbl SET full_name = '$customername' WHERE id = '$customerid'";
    $sql = "UPDATE usertbl SET email = '$customeremail' WHERE id = '$customerid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: customers.php");
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
}
else{
    echo "Некоректні дані";
}
mysqli_close($conn);
?>
        </div>
    </div>
</body>
</html>