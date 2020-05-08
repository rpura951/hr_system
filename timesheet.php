<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "hr_system");
$un = $_SESSION['username'];
$today = date('Y-m-d');
$chk_date = "SELECT * FROM timesheet WHERE username = '$un' and date = '$today'";
$result = mysqli_query($db, $chk_date);;
$rows = mysqli_num_rows($result);

//Checks if there is an entry already created for that username and date
if($rows > 0)
{
    $result = $db->query($chk_date);
    $result = $result->fetch_row();

    $_SESSION['date'] = $result[6];
    $_SESSION['clockin'] = $clockin = $result[0];
    $_SESSION['lunchout'] = $lunchout = $result[3];
    $_SESSION['lunchin'] = $lunchin = $result[2];
    $_SESSION['clockout'] = $clockout = $result[1];

    // $data->date = $result[6];
    // $data->clockin = $result[0];
    // $data->lunchout = $result[3];
    // $data->lunchin = $result[2];
    // $data->clockout = $result[1];

    print json_encode([
        'success' => true,
        'data' => $result
    ]);
}
else //If there isn't a match, it sets all text to ""
{
    $clockin = "";
    $lunchout = "";
    $lunchin = "";
    $clockout = "";
    $add_date = "";
}

if(isset($_GET['clockin']))
{
    $_SESSION['clockIn'] = date('H:i:s');
    $clockin = $_SESSION['clockIn'];
    $add_date = "INSERT INTO timesheet (date, start, username, end, lunch_in, lunch_out, total_worked)
                 VALUES ('$today', '$clockin', '$un', '00:00:00', '00:00:00', '00:00:00', 0)";
    

    if($db->query($add_date) === TRUE)
    {
        echo("It worked");
    }
    else
    {
        echo("Failed");
    }
}

if(isset($_GET['lunchout']))
{
    $lunchout = date('H:i:s');
    $add_date = "UPDATE timesheet SET lunch_out = '$lunchout' WHERE username = '$un' AND date = '$today'";
    $db->query($add_date);
}

if(isset($_GET['lunchin']))
{
    $lunchin = date('H:i:s');
    $add_date = "UPDATE timesheet SET lunch_in = '$lunchin' WHERE username = '$un' AND date = '$today'";
    $db->query($add_date);
}

if(isset($_GET['clockout']))
{
    $clockout = date('H:i:s');
    $add_date = "UPDATE timesheet SET end = '$clockout' WHERE username = '$un' AND date = '$today'";
    $db->query($add_date);

    $calcQuery = "Set @start = (SELECT start FROM timesheet WHERE username = '$un' AND date = '$today');";
    $db->query($calcQuery);
    $calcQuery = "SET @end = (SELECT end FROM timesheet WHERE username = '$un' AND date = '$today');";    
    $db->query($calcQuery);
    $calcQuery = "SET @lunchstart = (SELECT lunch_out FROM timesheet WHERE username = '$un' AND date = '$today');";    
    $db->query($calcQuery);
    $calcQuery = "SET @lunchend = (SELECT lunch_in FROM timesheet WHERE username = '$un' AND date = '$today');";    
    $db->query($calcQuery);
    $calcQuery = "SET @total = TIME_TO_SEC(TIMEDIFF(@end, @start))/3600 - TIME_TO_SEC(TIMEDIFF(@lunchend, @lunchstart))/3600;";
    $db->query($calcQuery);
    $calcQuery = "UPDATE timesheet SET total_worked = ROUND(@total,2) WHERE username = '$un' AND date = '$today';";
    $db->query($calcQuery);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Timesheet</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="css/registration.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="timesheet.js"></script>
        <style>
            th, td
            {
                padding:5px
            }
            .timesheet
            {
                width: 100px;
            }
        </style>
    </head>
    
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <h3>Menu</h3>
                        <li><a href="#">Clock In/Out</a></li>
                        <li><a href="#">Request Vacation</a></li>
                        <li><a href="registration_page.html">Regsiter New User</a></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo($_SESSION['fname']."'s Timesheet") ?></h1>
            <form method="get" enctype="multipart.form-data">
                <table style="border: 70px;">
                    <tr>
                        <td style="width100px; text-align:left;">Clock In</td>
                        <td><?php echo($clockin); ?></td>
                        <td><button class="timesheet" type="submit" name="clockin">Clock In</button></td>
                    </tr>
                    <tr>
                        <td style="width100px; text-align:left;">Lunch Out</td>
                        <td><?php echo ($lunchout) ?></td>
                        <td><button class="timesheet" type="submit" name="lunchout">Lunch Out</button></td>
                    </tr>
                    <tr>
                        <td style="width100px; text-align:left;">Lunch In</td>
                        <td><?php echo ($lunchin) ?></td>
                        <td><button class="timesheet" type="submit" name="lunchin">Lunch In</button></td>
                    </tr>
                    <tr>
                        <td style="width100px; text-align:left;">Clock Out</td>
                        <td><?php echo ($clockout) ?></td>
                        <td><button class="timesheet" type="submit" name="clockout">Clock Out</button></td>
                    </tr>
                    <?php echo $calcQuery ?>
                </table>
            </form>
        </div>
    </body>
</html>