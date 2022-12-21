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
            <h2>Додаємо користувача</h2>
            <form action="insert_customers.php" method="post">
                <p>ПІБ:</p>
                <p><input type="text" name="customer_name" /></p>
                <p>Електронна пошта:</p>
                <p><input type="text" name="customer_email" /></p>
                <p><input type="submit" class="button" value="Добавить"></p>
            </form>
        </div>
    </div>
</body>
</html>