<?php

session_start();
ob_start();  //output buffering
header("Content-Type: application/json");

//Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'hr_system');
if (mysqli_connect_errno()) {
    print json_encode([
        'success' => false,
        'error' => 'Could not connect to database'
    ]);
    exit;
}

try {
    $today = date('Y-m-d');
    // Checks if there's a server request and if it's GET OR POST 
    $action = isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'GET') ? 'get' : 'post';
    // Process Server requests
    switch($action) {
        // Process GET requests
        case 'get':
            $un = $_GET['username'];
            if(!isset($un)) {
                throw new Exception('Username Not Found');
                exit;
            }
            $chk_date = "SELECT * FROM timesheet WHERE username='$un' and date='$today' ";
            $result = $db->query($chk_date);
            if($result->num_rows > 0) 
            {
                $result = $result->fetch_assoc();
                print json_encode([
                    'success' => true,
                    'data' => $result
                ]);
            } else {  //Can't find table entry for user and current date 
                print json_encode([
                    'success' => false, 
                ]);
            }
            exit;

        // Process POST requests
        case 'post':
            $success = false;
            $option = $_POST['option'];
            $un = $_POST['username'];
            // Check to see if client send an option or username
            if (!isset($option)) {
                throw new Exception('Option Not Found');
            } else if (!isset($un)) {
                throw new Exception('Username Not Found');
            }

            $time = null;
            // Process the option
            switch($option) {
                
                case 'clockin':

                    break;
                case 'lunchin':

                    break;
                
                case 'lunchout':
                    
                    break;

                case 'clockout':

                    break;
            }
            //successful database entry
            if (isset($time))
            {
                print json_encode([
                    'success' => true,
                    'time' => $time
                ]);
            } 
            else  // Option not found
            {
                throw new Exception("Option is Invalid: {$option}");
            }
            exit;
    }
} catch(Exception $e) {
    print json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

?>