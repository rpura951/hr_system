<?php
    include 'verification.php';

    if(isset($_POST['Create']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $addr = $_POST['address'];
        $un = $_POST['username'];
        if (!verify_pw($_POST['tempPwd']))
        {
            echo("Password does not meet proper requirements");
        }
        else
        {
            $pw = $_POST['tempPwd'];
        }
        
        if (!verify_ssn($_POST['ssn']))
        {
            echo("SSN not valid");
        }
        else
        {
            $ssn = $_POST['ssn'];
        }

        if (!verify_phone($_POST['phone']))
        {
            echo("Phone number not valid");
        }
        else
        {
            $phone = $_POST['phone'];
        }
        
        echo($fname);
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
            header("Location: http://localhost/hr_system/registration.html");
            exit();
        }
        else
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
            }
            else
            {
                echo("User added to emp_credentials table</br>");
                header("Location: http://localhost/hr_system/main_page.html");
                exit();
            }
        }
    }
?>