<?php
    include 'validation_fns.php';
    session_start();

    //Checks if user is not an admin. If not, they will be rerouted.
    if ($_SESSION['isAdmin'] == 0)
    {
        echo('<script language="javascript">');
        echo('alert("You require administrator priveleges to view this page.");
        window.location.href="http://localhost/hr_system/main_page.html"');
        echo('</script>');
    }

    //Registers user
    if(isset($_POST['Create']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $addr = $_POST['address'];
        $un = $_POST['username'];

        //Password validation
        if (!validate_pw($_POST['tempPwd']))
        {
            echo("Password does not meet proper requirements");
            exit;
        }
        else
        {
            echo("Password is valid");
            $pw = password_hash($_POST['tempPwd'], PASSWORD_DEFAULT);
        }
        
        //SSN Validation
        if (!validate_ssn($_POST['ssn']))
        {
            echo("SSN not valid");
            exit;
        }
        else
        {
            $ssn = $_POST['ssn'];
        }

        //Phone number validation
        if (!validate_phone($_POST['phone']))
        {
            echo("Phone number not valid");
            exit;
        }
        else
        {
            $phone = $_POST['phone'];
        }
        
        $db = mysqli_connect("localhost", "root", "", "hr_system");
        if(mysqli_connect_errno())
        {
            echo "<p>Error connecting to database.</p>";
        }
        else
        {
            echo "<p>Connection Successful</p>";
        }

        //Query to check if a username already matches
        $check_query = "SELECT username FROM emp_credentials WHERE username = '$un'";
        $result = mysqli_query($db, $check_query);
        if(mysqli_num_rows($result) > 0)
        {
            echo("Username already found");
            header("Location: http://localhost/hr_system/registration.php");
            exit();
        }
        else //If no match, it adds the user to the database
        {
            $add_query = "INSERT INTO emp_data (fname, lname, phone_number, address, username, ssn) VALUES ('$fname', '$lname', '$phone', '$addr', '$un', '$ssn')";
            echo($add_query);
            echo("</br>");
            if(!mysqli_query($db, $add_query))
            {
                echo("Unable to add users</br>");
            }
            else
            {
                echo("User added to emp_data table</br>");
            }
            $add_query = "INSERT INTO emp_credentials (username, password) VALUES ('$un', '$pw')";
            if(!mysqli_query($db, $add_query))
            {
                echo("Username and password not created</br>");
                echo($un."username </br>");
                echo($pw."password </br>");
            }
            else
            {
                echo("User added to emp_credentials table</br>");
                header("Location: http://localhost/hr_system/main_page.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Registration</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="css/registration.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            th, td
            {
                padding:5px
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
            <h1 class="page-header">Register New User</h1>
            <form method="post" enctype="multipart.form-data">
                <table style="border: 70px;">
                    <tr>
                        <td sytle="width100px; text-align:left;">First Name</td>
                        <td><input type="text" name="fname" required size="20" maxlength="20" /></td>
                    </tr>
                    <tr>
                        <td sytle="width100px; text-align:left;">Last Name</td>
                        <td><input type="text" name="lname" required size="20" maxlength="20" /></td>
                    </tr>
                        <td sytle="width100px; text-align:left;">Address</td>
                        <td><input type="text" name="address" required size="20" /></td>
                    </tr>
                        <td sytle="width100px; text-align:left;">Phone Number</td>
                        <td><input type="text" name="phone" required size="20" maxlength="20" /></td>
                    </tr>
                        <td sytle="width100px; text-align:left;">Username</td>
                        <td><input type="text" name="username" required size="20" maxlength="20" /></td>
                    </tr>
                    <tr>
                        <td sytle="width100px; text-align:left;">Temporary Password</td>
                        <td><input type="text" name="tempPwd" required size="20" maxlength="20" /></td>
                    </tr>
                    <tr>
                        <td sytle="width100px; text-align:left;">SSN</td>
                        <td><input type="text" name="ssn" required size="20" maxlength="9" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" formaction="registration.php" name="Create">Create User</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>