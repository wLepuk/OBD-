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
            <h2>Додаємо Клуб</h2>
            <form action="insert_clubs.php" method="post">
                <p>Назва:</p>
                <p><input type="text" name="club_name" /></p>
                <p>Кількість гравців:</p>
                <p><input type="number" name="players_amount" /></p>
                <p><input type="submit" class="button" value="Добавить"></p>
            </form>
        </div>
    </div>
</body>
</html>