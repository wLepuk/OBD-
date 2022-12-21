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
            <h2>Додаємо місце</h2>
            <form action="insert_place.php" method="post">
                <p>Кількість очок:</p>
                <p><input type="number" name="club_points" /></p>
                <p>Кількість матчів:</p>
                <p><input type="number" name="club_amount_of_games" /></p>
                <p><input type="submit" class="button" value="Добавить"></p>
            </form>
        </div>
    </div>
</body>
</html>