<?php

$db = mysqli_connect("localhost", "root", "", "hr_system");
$username = $_POST['emp_id'];
$password = $_POST['pwd'];

if(isset($_POST['submit']))
{
    $query = "SELECT username AND  password FROM emp_credentials WHERE username == 'username'";
    $stmt = $dp->prepare($query);
    $stmt->execute();
    echo("It worked");
}

?>