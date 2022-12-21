<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>League table</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
    <div class="container">
<h2>Список ліги</h2>
    </div>
<table>
    <tr>
        <th><a href="clubs.php">Клуби</a></th>
        <th><a href="customers.php">Користувачі</a></th>
        <th><a href="managers.php">Менеджери</a></th>
        <th><a href="players.php">Гравці</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Вийти</a></th>
    </tr>
</table>

<?php
session_start();
if(!isset($_SESSION["session_username"])):
header("location:login.php");
endif;
include "connect.php";
if($conn->connect_error){
    die("Помилка: " . $conn->connect_error);
}
$sql = "SELECT * FROM league_table";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Отримано об'єктів: $rowsCount</p>";
    echo "<table><tr><th>Кількість матчів</th><th>Кількість очок</th><th>ID</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["club_amount_of_games"] . "</td>";
            echo "<td>" . $row["club_points"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td>" . $row["place_id"] . "</td>";
            } else echo "<td>RESTRICTED</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_place.php?place_id=" . $row["place_id"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_place.php' method='post'>
                        <input type='hidden' name='place_id' value='" . $row["place_id"] . "' />
                        <input type='submit' class='button' value='Видалити'>
                   </form></td>";
            } else {
                echo "<td></td>";
                echo "<td></td>";
            }
        echo "</tr>";
    }
    echo "</table>";
    $result->free();
} else{
    echo "Помилка: " . $conn->error;
}
$conn->close();
if('admin' == $_COOKIE["userlevelcookie"])
echo "<table>
    <tr>
        <th><a href='form_place.php'>Додати нове місце</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>