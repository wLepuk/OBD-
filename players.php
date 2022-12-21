
<!DOCTYPE html>
<html>
<head>
<?php include("font.php"); ?>
<title>Players</title>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<div class="divbgbd">
<h2>Список гравців</h2>
<table>
    <tr>
        <th><a href="clubs.php">Клуби</a></th>
        <th><a href="customers.php">Користувачі</a></th>
        <th><a href="managers.php">Менеджери</a></th>
        <th><a href="index.php">Таблиця ліги</a></th>
        <th><?php echo $_COOKIE["usernamecookie"];?></th>
        <th><a href="logout.php">Вийти</a></th>
    </tr>
</table>
<?php
include "connect.php";
if($conn->connect_error){
    die("Помилка: " . $conn->connect_error);
}
$sql = "SELECT * FROM players";
if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows;
    echo "<p>Отримано об'єктів: $rowsCount</p>";
    echo "<table><tr><th>ID гравця</th><th>ПІБ гравця</th><th>ІД команди гравця</th><th></th><th></th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["player_id"] . "</td>";
            echo "<td>" . $row["player_name"] . "</td>";
            echo "<td>" . $row["team_id"] . "</td>";
            if('admin' == $_COOKIE["userlevelcookie"])
            echo "<td><a href='update_players.php?player_id=" . $row["player_id"] . "'>Змінити</a></td>";
            if('admin' == $_COOKIE["userlevelcookie"])
            echo "<td><form action='delete_players.php' method='post'>
                        <input type='hidden' name='player_id' value='" . $row["player_id"] . "' />
                        <input type='submit' class='button' value='Видалити'>
                   </form></td>";
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
        <th><a href='form_players.php'>Додати нового гравця</a></th>
    </tr>
</table>"
?>
</div>
</body>
</html>