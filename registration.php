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
            $add_query = "INSERT INTO emp_data VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($add_query);
            $stmt->bind_param('ssssss', $fname, $lname, $phone, $addr, $un, $ssn);
            $stmt->execute();
            $add_query = "INSERT INTO emp_credentials VALUES (?, ?)";
            $stmt = $db->prepare($add_query);
            $stmt->bind_param("ss", $un, $pw);
            $stmt->execute();
            $stmt->close();
            echo("User added");
        }
    }
?>