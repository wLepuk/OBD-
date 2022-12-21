<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if(isset($_POST["manager_id"]))
{
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $managerid = mysqli_real_escape_string($conn, $_POST["manager_id"]);
    $sql = "DELETE FROM managers WHERE manager_id = '$managerid'";
    if(mysqli_query($conn, $sql)){
         
        header("Location: managers.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);    
}
?>