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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["club_id"]))
{
    $clubid = mysqli_real_escape_string($conn, $_GET["club_id"]);
    $sql = "SELECT * FROM club WHERE club_id = '$clubid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $clubname = $row["club_name"];
                $playersamount = $row["players_amount"];
            }
            echo "<h2>Оновлення даних клубу</h2>
                <form method='post'>
                    <input type='hidden' name='club_id' value='$clubid' />
                    <p>Кількість гравців:</p>
                    <p><input type='number' name='players_amount' value='$playersamount' /></p>
            </form>";
        }
        else{
            echo "<div>Клуб не знайдено/div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["club_id"]) && isset($_POST["players_amount"])) {
      
    $clubid = mysqli_real_escape_string($conn, $_POST["club_id"]);
    $playersamount = mysqli_real_escape_string($conn, $_POST["players_amount"]);
      
    $sql = "UPDATE club SET players_amount = '$playersamount' WHERE club_id = '$clubid'";
    if($result = mysqli_query($conn, $sql)){
        header("Location: index.php");
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