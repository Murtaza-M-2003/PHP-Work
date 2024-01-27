<?php

session_start();

$_SESSION["username"] = "Murtaza-M-2003";
$_SESSION["useremail"] = "murtazamusheer2008@gmail.com";
$_SESSION["userpass"] = "12345";


echo "<h1>" . "Signup your account" . "</h1>";

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <br><br><br><br>

    <form action="post">

        <div class="form-floating mb-3">
            <input type="name" class="form-control" id="floatingName" placeholder="">
            <label for="floatingName">User Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="">
            <label for="floatingInput">User Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="">
            <label for="floatingPassword">User Pasword</label>
        </div>

    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>