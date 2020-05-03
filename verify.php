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