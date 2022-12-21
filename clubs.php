<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Clubs</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>Список клубів</h2>
<table>
    <tr>
        <th><a href="index.php">Таблиця ліги</a></th>
        <th><a href="customers.php">Користувачі</a></th>
        <th><a href="managers.php">Менеджери</a></th>
        <th><a href="players.php">Гравці</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Вийти</a></th>
    </tr>
</table>
<?php
include "connect.php";
if($conn->connect_error){
    die("Помилка: " . $conn->connect_error);
}
$sql = "SELECT * FROM club";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Отримано об'єктів: $rowsCount</p>";
    echo "<table><tr><th>ID клубу</th><th>Назва Клубу</th><th>Кількість гравців</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["club_id"] . "</td>";
            echo "<td>" . $row["club_name"] . "</td>";
            echo "<td>" . $row["players_amount"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_clubs.php?club_id=" . $row["club_id"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_clubs.php' method='post'>
                        <input type='hidden' name='club_id' value='" . $row["club_id"] . "' />
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
        <th><a href='form_clubs.php'>Додати новий клуб</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>