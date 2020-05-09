<?php
session_start();
ob_start();
header('Content-Type: application/json');

try {
    if(!isset($_POST['emp_id']) or !isset($_POST['pwd']))
        throw new Exception('Empty Username or Password');

    $db = mysqli_connect("localhost", "root", "", "hr_system");
    if (mysqli_connect_errno())
        throw new Exception('Could not connect to database');
        
    $username = $_POST['emp_id'];
    $password = $_POST['pwd'];
    $query = "SELECT username, password FROM emp_credentials WHERE username = '$username'";
    $result = $db->query($query);

    //Checks if there is is a username that matches
    if ($result->num_rows > 0)
    {
        $result = $result->fetch_assoc();
        if (password_verify($password, $result['password']))
        {
            $query = "SELECT * FROM emp_data WHERE username = '$username'";
            $result = $db->query($query);
            $result = $result->fetch_assoc();

            print json_encode([
                'success' => true,
                'username' => $result['username'],
                'fname' => $result['fname'],
                'isAdmin' => $result['isAdmin']
            ]);
            exit;
        }
        throw new Exception('Incorrect Password');
    }
    throw new Exception("Username Not Found: {$username}");

} catch(Exception $e) {
    print json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

?>