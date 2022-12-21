<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["place_id"]))
{
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $placeid = mysqli_real_escape_string($conn, $_POST["place_id"]);
    $sql = "DELETE FROM league_table WHERE place_id = '$placeid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: index.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>