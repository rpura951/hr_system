<?php
session_start();
include 'validation_fns.php';
require 'database.php';


try{
    $db = connect_to_db();
    $un = $_SESSION['un'];
    if (isset($_POST['update']))
    {
        echo(var_dump([$_POST]));
        $tempPwd = $_POST['tempPwd'];
        $query = "SELECT username, password FROM emp_credentials WHERE username = '$un'";
        $result = $db->query($query);
        //echo ($result['password']);
        //$result = $result->fetch_assoc();
        //echo($result['username'].'</br>');
        //echo($result['password'].'</br>');
        //echo(password_verify($tempPwd, $result['password']));

        if ($result->num_rows > 0)
        {
            $result = $result->fetch_assoc();
            if (password_verify($tempPwd, $result['password']))
            {
                $hashed = password_hash($_POST['newPwd'], PASSWORD_DEFAULT);
                $update = "UPDATE emp_credentials SET password = '$hashed' WHERE username = '$un';";
                $db->query($update);
                throw new Exception($update);
            }
            else{
                throw new Exception("Incorrect temporary password");
            }
        }
    }
} catch (Exception $e)
{
    echo($e->getMessage());
    //header("Location: http://localhost/hr_system/html/pwd_reset.html");
}
?>