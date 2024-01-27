<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "murtazaTodoApp";
$tableName = "UserINFO2";



$connection = mysqli_connect($server, $username, $password, $database);

$sql = " CREATE DATABASE IF NOT EXISTS $database ";

$resdb = mysqli_query($connection, $sql);
if (!$resdb) {
    die("There is an error" . mysqli_connect_error());
}

$createT = " CREATE TABLE IF NOT EXISTS $tableName (
    ID int auto_increment primary key not null,
    Name nvarchar(255),
    Email nvarchar(255),
    Contact int(11),
    Title nvarchar(255),
    Description nvarchar(1000),
    Date DATE DEFAULT CURRENT_TIMESTAMP()
) ";

$resT = mysqli_query($connection, $createT);
if (!$resT) {
    die("There is an error" . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $del = $_GET['delete'];
    $delsingle = "Delete from $tableName where Id='$del'";
    $delres = mysqli_query($connection, $delsingle);
    $delete = true;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['editid'])) {
        $id = $_POST["editid"];
        $title = $_POST["titleEdit"];
        $desc = $_POST["descEdit"];
        $updQuery = "update $tableName set Title='$title', Description='$desc' where $tableName.id='$id'";
        $resquery = mysqli_query($connection, $updQuery);
        if ($resquery) {
            $update = true;
        } else {
            echo "Not updated";
        }
    } else if (isset($_POST['delAll'])) {
        $delAllInfo = "Delete from $tableName";
        $delAllInfores = mysqli_query($connection, $delAllInfo);
        $delete = true;

    } else if ($_SERVER['REQUEST_METHOD'] == "POST"  && isset($_POST['form_submitted'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $title = $_POST["title"];
        $desc = $_POST["desc"];
        $inssql = "INSERT INTO $tableName (Name, Email, Contact, Title, Description) VALUES ('$name','$email','$contact','$title','$desc')";
        $ressql = mysqli_query($connection, $inssql);

        if ($ressql) {
            $insert = true;
        } else {
            $insert = false;
            echo "Error: " . mysqli_error($connection);
        }

        // if ($name == "" && $email == "" && $contact == "" && $title == "" && $desc =="") {
        //     $insert = false;
        // } 

    }
}

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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <form action="index.php" method="POST">
            <input type="hidden" name="form_submitted" value="1">
            <div class="form-floating mb-3">
                <input type="text" name="name" required class="form-control" id="name" placeholder="">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" required class="form-control" id="email" placeholder="">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="contact" required class="form-control" id="contact" placeholder="">
                <label for="contact">Contact</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="title" required class="form-control" id="title" placeholder="">
                <label for="title">Title</label>
            </div>
            <div class="form-floating">
                <textarea name="desc" required class="form-control" placeholder="" id="desc"></textarea>
                <label for="desc">Description</label>
            </div>
            <div class="d-grid gap-2 mt-5">
                <button class="btn btn-primary" name="insert" type="submit">Insert</button>
            </div>
        </form>
        <form action="index.php" method="POST">
            <input type="hidden" name="delAll">
            <div class="col-lg-12">
                <button class="btn btn-danger w-100" type="submit">Delete All</button>
            </div>
        </form>
    </div>



    <div class="container">
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Update/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Tselect = "SELECT * FROM $tableName";
                $reSelect = mysqli_query($connection, $Tselect);

                $count = 1;
                while ($info = mysqli_fetch_assoc($reSelect)) {

                    echo "<tr>";
                    echo "<td>" . $info['ID'] . "</td>";
                    // echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $info['Name'] . "</td>";
                    echo "<td>" . $info['Email'] . "</td>";
                    echo "<td>" . $info['Contact'] . "</td>";
                    echo "<td>" . $info['Title'] . "</td>";
                    echo "<td>" . $info['Description'] . "</td>";

                    echo "<td> 

                    <button class='btn btn-primary upd' type='submit' data-bs-toggle='modal' data-bs-target='#exampleModal' id=" . $info['ID'] . ">Update</button>
                    <button class='btn btn-danger delete' type='submit'. id=delete" . $info['ID'] . ">Delete</button>

                    </td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">My Update Note </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <input type="hidden" name="editid" id="editid">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" name="titleEdit" id="titleEditt">
                            <label for="floatingInput">Title</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="" name="descEdit" id="descEditt">
                            <label for="floatingInput2">Description</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary upd">Update changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>



<script>

    let insert = document.getElementsByClassName("insert");
    let upd = document.getElementsByClassName("upd");
    let deletes = document.getElementsByClassName("delete");

    // Array.from(insert).forEach((insertbtn) => {
    //     insertbtn.addEventListener("click", (e) => {
    //         console.log("btn is working....");
    //     })
    // })

    Array.from(upd).forEach((updbtn) => {
        updbtn.addEventListener("click", (e) => {
            tr = e.target.parentNode.parentNode;
            title = tr.getElementsByTagName("td")[4].innerText;
            desc = tr.getElementsByTagName("td")[5].innerText;
            titleEditt.value = title;
            descEditt.value = desc;
            editid.value = e.target.id;
        })
    })

    Array.from(deletes).forEach((deletesbtn) => {
        deletesbtn.addEventListener("click", (e2) => {
            // console.log("my delete btn is working ");
            sno = e2.target.id.substr(6);
            if (confirm("Do you want to delete this task")) {
                window.location = `/murtazaphp/MurtazaTodoApp/index.php?delete=${sno}`;
            }
        })
    })

</script>