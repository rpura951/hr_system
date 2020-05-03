<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <style>
        .center-form
        {
            background-color:rgb(255, 255, 255);
            width:300px;
            border:2px black;
            padding:50px;
            margin-left: auto;
            margin-right:auto;
        }
        h1
        {
            text-align: center;
        }
        body
        {
            text-align: center;
            background-color:paleturquoise;
        }
        .login
        {
            /* text-align: center; */
        }
        input[type=text], [type=submit], [type=password]
        {
            margin-left: auto;
            margin-right:auto;
            margin-top:10px;
            margin-bottom:10px;
        }
    </style>
    <body>
        <div class="container-fluid">
            <h1>THE BEST LOGO EVER</h1>    
        </div>
        <div class="container-fluid">
            <div class="center-form">
                <form method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td style="width: 100px; text-align: left;">Username</td>
                            <td><input type="text" name="emp_id" required size="20" maxlength="20" /></td>
                        </tr>
                        <tr>
                            <td style="width: 100px; text-align: left;">Password</td>
                            <td><input type="password" name="pwd" required size="20" maxlength="20" /></td>
                        </tr>
                        <tr>
                            
                        </tr>
                    </table>
                    <button name="verify" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
session_start();

$db = mysqli_connect("localhost", "root", "", "hr_system");


if(isset($_POST['verify']))
{
    $username = $_POST['emp_id'];
    $password = $_POST['pwd'];
    $query = "SELECT username, password FROM emp_credentials WHERE username = '$username'";
    $result = $db->query($query);

    if ($result->num_rows > 0)
    {
        $result = $result->fetch_assoc();
        if (password_verify($password, $result['password']))
        {
            $query = "SELECT * FROM emp_data WHERE username = '$username'";
            $result = $db->query($query);
            $result = $result->fetch_assoc();
            $_SESSION['fname'] = $result['fname'];
            $_SESSION['isAdmin'] = $result['isAdmin'];
            //echo($_SESSION['fname']);
            header("Location: http://localhost/hr_system/main_page.php");
            // echo('<script language="javascript">');
            // echo('alert("Login Successful");
            // window.location.href="http://localhost/hr_system/main_page.html"');
            // echo('</script>');
        }
    }
    else
    {
        echo('<script language="javascript">');
        echo('alert("Login Failed. Please Try Again.");
        window.location.href="http://localhost/hr_system/login.html"');
        echo('</script>');
    }
}

?>