<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["club_points"]) && isset($_POST["club_amount_of_games"])) {
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $clubpoints = mysqli_real_escape_string($conn, $_POST["club_points"]);
    $clubamountofgames = mysqli_real_escape_string($conn, $_POST["club_amount_of_games"]);
    $sql = "INSERT INTO league_table (club_points, club_amount_of_games) VALUES ($clubpoints, $clubamountofgames)";
        if(mysqli_query($conn, $sql)){
            header("Location: index.php");
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>