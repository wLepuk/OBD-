<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/base.css">
<?php include("font.php"); ?>
<title>inserting...</title>
<meta charset="utf-8" />
</head>
<body>
    <div class="divbg">
        <div class="regform">
            <h2>Додаємо гравця</h2>
            <form action="insert_players.php" method="post">
                <p>ID гравця:</p>
                <p><input type="number" name="player_id" /></p>
                <p>ID клубу:</p>
                <p><input type="number" name="team_id" /></p>
                <p>ПІБ:</p>
                <p><input type="text" name="player_name" /></p>
                <p><input type="submit" class="button" value="Добавить"></p>
            </form>
        </div>
    </div>
</body>
</html>