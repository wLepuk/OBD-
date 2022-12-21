<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Customers</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>Список користувачів</h2>
<table>
    <tr>
        <th><a href="clubs.php">Клуби</a></th>
        <th><a href="index.php">Таблиця ліги</a></th>
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
$sql = "SELECT * FROM usertbl";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Отримано об'єктів: $rowsCount</p>";
    echo "<table><tr><th>ID користувача</th><th>ПІБ Користувача</th><th>Пошта</th><th>Нікнейм</th><th>Рівень доступу</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["level"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"]){
            echo "<td><a href='update_customers.php?id=" . $row["id"] . "'>Змінити</a></td>";
            echo "<td><form action='delete_customers.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
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
        <th><a href='form_customers.php'>Додати нового користувача</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>