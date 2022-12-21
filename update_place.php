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
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["place_id"]))
{
    $placeid = mysqli_real_escape_string($conn, $_GET["place_id"]);
    $sql = "SELECT * FROM league_table WHERE place_id = '$placeid'";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $placeid = $row["place_id"];
                $clubpoints = $row["club_points"];
                $clubamountofgames = $row["club_amount_of_games"];
            }
            echo "<h2>Оновлення даних таблиці ліги</h2>
                <form method='post'>
                    <input type='hidden' name='place_id' value='$placeid' />
                    <p>Кількість матчів</p>
                    <p><input type='number' name='club_points' value='$clubpoints' /></p>
                    <p>Кількість очок</p>
                    <p><input type='number' name='club_amount_of_games' value='$clubamountofgames' /></p>
                    <p><input type='submit' class='button' value='Зберегти'></p>
            </form>";
        }
        else{
            echo "<div>Місце не знайдено</div>";
        }
        mysqli_free_result($result);
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
}
elseif (isset($_POST["place_id"]) && isset($_POST["club_points"]) && isset($_POST["club_amount_of_games"])) {
      
    $placeid = mysqli_real_escape_string($conn, $_POST["place_id"]);
    $clubpoints = mysqli_real_escape_string($conn, $_POST["club_points"]);
    $clubamountofgames = mysqli_real_escape_string($conn, $_POST["club_amount_of_games"]);
      
    $sql = "UPDATE league_table SET place_id = '$placeid', club_points = '$$clubpoints', club_amount_of_games = '$clubamountofgames'";
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