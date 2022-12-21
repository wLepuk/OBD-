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
                if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["player_id"]))
                {
                    $playerid = mysqli_real_escape_string($conn, $_GET["player_id"]);
                    $sql = "SELECT * FROM players WHERE player_id = '$playerid'";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            foreach($result as $row){
                                $playerid = $row["player_id"];
                                $teamid = $row["team_id"];
                                $playername = $row["player_name"];
                            }
                            echo "<h2>Оновлення даних гравця</h2>
                                <form method='post'>
                                    <input type='hidden' name='player_id' value='$playerid' />
                                    <p>ID клубу:</p>
                                    <p><input type='number' name='team_id' value='$teamid' /></p>
                                    <p>ПІБ Гравця:</p>
                                    <p><input type='text' name='player_name' value='$playername' /></p>
                                    <p><input type='submit' class='button' value='Зберегти'></p>
                            </form>";
                        }
                        else{
                            echo "<div>Гравця не знайдено</div>";
                        }
                        mysqli_free_result($result);
                    } else{
                        echo "Помилка: " . mysqli_error($conn);
                    }
                }
                elseif (isset($_POST["player_id"]) && isset($_POST["team_id"]) && isset($_POST["player_name"])) {
                    
                    $playerid = mysqli_real_escape_string($conn, $_POST["player_id"]);
                    $teamid = mysqli_real_escape_string($conn, $_POST["team_id"]);
                    $playername= mysqli_real_escape_string($conn, $_POST["player_name"]);
                    
                    $sql = "UPDATE players SET team_id = '$teamid', player_name = '$playername', player_id = '$playerid'";
                    if($result = mysqli_query($conn, $sql)){
                        header("Location: players.php");
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