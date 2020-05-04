<?php
session_start();

$name = $_SESSION['fname'];
$greeting = array($name, $_SESSION['isAdmin']);

print json_encode($greeting);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Main Menu</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="css/registration.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            th, td
            {
                padding:5px;
            }
        </style>
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <h3>Menu</h3>
                        <hr>
                        <li><a href="#">Clock In/Out</a></li>
                        <li><a href="#">Request Vacation</a></li>
                        <li><a href="#">View Paystub</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"> <?php echo "Hello, ".$name ?> </h1>
        </div>
        <script src="//code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="admin.js"></script>
    </body>
</html>