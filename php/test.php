<?php 

    include 'mailer.php';
    include 'database.php';

    $email = 'rpura951@gmail.com';
    $subject = 'Test E-mail';
    $body = '<h1> 2nd Teset E-mail <h1>';
    
    mailTo($email, $subject, $body);

    $db = connect_to_db();

?>