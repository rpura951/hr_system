<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>User Registration</title>
    </head>
    <body>
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
                    <td><button type="submit" name="Create">Create User</button></td>
                </tr>

    </body>
</html>

<?php
    if(isset($_POST['Create']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $addr = $_POST['address'];
        $un = $_POST['username'];
        $pw = $_POST['tempPwd'];
        $ssn = $_POST['ssn'];
        $phone = $_POST['phone'];

        $db = mysqli_connect("localhost", "root", "", "hr_system");
        if(mysqli_connect_errno())
        {
            echo "<p>Error connecting to database.</p>";
        }
        else
        {
            echo "<p>Connection Successful</p>";
        }

        $check_query = "SELECT username FROM emp_credentials WHERE username = '$un'";
        $result = mysqli_query($db, $check_query);
        if(mysqli_num_rows($result) > 0)
        {
            echo("Username already found");
        }
        else
        {
            $add_query = "INSERT INTO emp_data (fname, lname, phone_number, address, username, ssn) VALUES ('$fname', '$lname', '$phone', '$addr', '$un', '$ssn')";
            if(!mysqli_query($db, $add_query))
            {
                echo("Unable to add users");
            }
            else
            {
                echo("User added to emp_data table</br>");
            }
            $add_query = "INSERT INTO emp_credentials (username, password) VALUES ('$un', '$pw')";
            if(!mysqli_query($db, $add_query))
            {
                echo("Username and password not created");
            }
            else
            {
                echo("User added to emp_credentials table</br>");
            }
        }
    }
?>