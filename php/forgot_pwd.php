<?php
include 'generatePass.php';
include 'mailer.php';
require 'database.php';

try{
    $db = connect_to_db();

    if (isset($_POST['reset']))
    {
        $un = $_POST['emp_id'];
        $email = $_POST['email'];
        $query = "SELECT username, email FROM emp_data WHERE username = '$un' AND email = '$email'";
        $result = $db->query($query);
        
        if ($result->num_rows == 0)
            throw new Exception('Matching username and e-mail not found');
        else
        {
            $tempPassword = generatePass();
            $hashed = password_hash($tempPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE emp_credentials SET pwd_reset = 1,  password = '$hashed';";
            $db->query($updateQuery);
            mailTo($email, "Password Reset", $tempPassword);
        }

    }
} catch (Exception $e){
    echo($e->getMessage());
}



?>