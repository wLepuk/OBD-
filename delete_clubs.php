<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["club_id"]))
{
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $clubid = mysqli_real_escape_string($conn, $_POST["club_id"]);
    $sql = "DELETE FROM club WHERE club_id = '$clubid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: club.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>