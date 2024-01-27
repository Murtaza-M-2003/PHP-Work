<?php

session_start();

if (isset($_SESSION["username"])) {

    echo "<h4>" . "Your Username :" . " " . $_SESSION["username"]  . "<br>" . "Your Useremail :" . " " . $_SESSION["useremail"] . "<br>" . "Your Password :" . " " . $_SESSION["userpass"] . "<h4>";

} else {

    header("location:signup.php");

}

echo "<h1>" . "Welcome" . " " . $_SESSION["username"] . "<h1>";

?>

