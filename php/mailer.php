<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\Oauth;

    // Alias the League Google OAuth2 provider class
    use League\OAuth2\Client\Provider\Google;

    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('America/Los_Angeles');

    // Load Composer's autoloader
    require realpath(__DIR__ . '/../dotenv.php');

    function mailTo($destAddr, $subject, $body) {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();

            //Enable SMTP debugging
            // SMTP::DEBUG_OFF = off (for production use)
            // SMTP::DEBUG_CLIENT = client messages
            // SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;

            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 587;

            //Set the encryption mechanism to use - STARTTLS or SMTPS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Set AuthType to use XOAUTH2
            $mail->AuthType = 'XOAUTH2';

            //Fill in authentication details here
            //Either the gmail account owner, or the user that gave consent
            $email = $_ENV['MAIL_USERNAME'];
            $clientId = $_ENV['MAIL_CLIENT_ID'];
            $clientSecret = $_ENV['MAIL_CLIENT_SECRET'];

            //Obtained by configuring and running get_oauth_token.php
            //after setting up an app in Google Developer Console.
            $refreshToken = $_ENV['MAIL_REFRESH_TOKEN'];

            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );

            //Pass the OAuth provider instance to PHPMailer
            $mail->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                        'refreshToken' => $refreshToken,
                        'userName' => $email,
                    ]
                )
            );

            //Set who the message is to be sent from
            //For gmail, this generally needs to be the same as the user you logged in as
            $mail->setFrom('hr.system.management@gmail.com', 'First Last');

            //Set who the message is to be sent to
            $mail->addAddress($destAddr);

            //Set the subject line
            $mail->Subject = $subject;

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            // $mail->msgHTML(file_get_contents('contentsutf8.html'), __DIR__);
            $mail->isHTML(true);

            $mail->Body = $body;
            //Replace the plain text body with one created manually
            $mail->AltBody = $body;

            //Attach an image file
            // $mail->addAttachment('images/phpmailer_mini.png');
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            throw new Exception ("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
?>