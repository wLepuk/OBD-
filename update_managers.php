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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["manager_id"]))
{
    $managerid = mysqli_real_escape_string($conn, $_GET["manager_id"]);
    $sql = "SELECT * FROM managers WHERE manager_id = '$managerid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $managername = $row["manager_name"];
            }
            echo "<h2>Оновлення даних менеджера</h2>
                <form method='post'>
                    <input type='hidden' name='manager_id' value='$managerid' />
                    <p>ПІБ:</p>
                    <p><input type='text' name='manager_name' value='$managername' /></p>
                    <p><input type='submit' class='button' value='Зберегти'></p>
            </form>";
        }
        else{
            echo "<div>Менеджера не знайдено</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["manager_id"]) && isset($_POST["manager_name"])) {
      
    $managerid = mysqli_real_escape_string($conn, $_POST["manager_id"]);
    $managername = mysqli_real_escape_string($conn, $_POST["manager_name"]);
      
    $sql = "UPDATE managers SET manager_name = '$managername' WHERE manager_id = '$managerid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: managers.php");
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