<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["club_name"]) && isset($_POST["players_amount"])) {
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $clubname = mysqli_real_escape_string($conn, $_POST["club_name"]);
    $price = mysqli_real_escape_string($conn, $_POST["players_amount]);
    $sql = "INSERT INTO club (club_name, players_amount) VALUES ('$clubname', $players_amount)";
        if(mysqli_query($conn, $sql)){
            header("Location: clubs.php");
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>