<?php 
if('admin' != $_COOKIE["userlevelcookie"]){
    header("Location: intropage.php");
}
?>
<?php
if (isset($_POST["manager_name"])) {
    include "connect.php";
    if (!$conn) {
      die("Помилка: " . mysqli_connect_error());
    }
    $managername = mysqli_real_escape_string($conn, $_POST["manager_name"]);
    $sql = "INSERT INTO managers (manager_name) VALUES ('$managername')";
        if(mysqli_query($conn, $sql)){
            header("Location: managers.php");
    } else{
        echo "Помилка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>