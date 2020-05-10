<?php
include 'generatePass.php';

try{
    $db = mysqli_connect("localhost", "root", "", "hr_system");
    if (mysqli_connect_errno())
        throw new Exception('Could not connect to database');

    if (isset($_POST['verify']))
    {
        $un = $_POST['emp_id'];
        $email = $_POST['email']
        $query = "SELECT username, email FROM emp_data WHERE username = '$un' AND email = '$email'";
        $result = $db->query($query);
        
        if ($result->num_rows == 0)
            throw new Exception('Matching username and e-mail not found');
        else
        {
            $tempPassword = generatePass();
            $hashed = password_hash($tempPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE emp_data SET 'pwd_reset' = 1,  'password' = '$hashed';";
            $db->query($updatedQuery);
        }

    }
} catch Exception($e)
{
    $e->getMessage();
}


?>