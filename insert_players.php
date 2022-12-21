<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["team_id"]) && isset($_POST["player_name"])) {
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $teamid = mysqli_real_escape_string($conn, $_POST["team_id"]);
    $playername = mysqli_real_escape_string($conn, $_POST["player_name"]);
    $sql = "INSERT INTO players (team_id, player_name) VALUES ($teamid, '$playername')";
        if(mysqli_query($conn, $sql)){
            header("Location: players.php");
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>