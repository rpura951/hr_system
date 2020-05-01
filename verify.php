<?php

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
            echo("It worked");
            header("Location: http://localhost/hr_system/main_page.html");
        }
        else
        {
            echo("You suck");
        }
    }
}

?>