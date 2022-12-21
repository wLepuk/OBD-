<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["player_id"]))
{
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $playerid = mysqli_real_escape_string($conn, $_POST["player_id"]);
    $sql = "DELETE FROM players WHERE player_id = '$playerid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: players.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>