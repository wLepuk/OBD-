<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Managers</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>Список менеджерів</h2>
<table>
    <tr>
        <th><a href="clubs.php">Клуби</a></th>
        <th><a href="customers.php">Користувачі</a></th>
        <th><a href="index.php">Таблиця ліги</a></th>
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
$sql = "SELECT * FROM managers";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Отримано об'єктів: $rowsCount</p>";
    echo "<table><tr><th>ID менеджера</th><th>ПІБ Менеджера</th><th></th><th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["manager_id"] . "</td>";
            echo "<td>" . $row["manager_name"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_managers.php?manager_id=" . $row["manager_id"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_managers.php' method='post'>
                        <input type='hidden' name='manager_id' value='" . $row["manager_id"] . "' />
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
        <th><a href='form_managers.php'>Додати нового менеджера</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>