<?php

//session_start();

//include "paystub_output.php";
$db = mysqli_connect("localhost", "root", "", "hr_system");
if (mysqli_connect_errno())
{
    print json_encode([
        'success' => false,
        'error' => 'Could not connect to databse'
    ]);
    exit;
}
echo("Here");
try{
    echo("Now Here");
    $totalHrs = 0.0;
    $month = date('m');
    $day = date('d');
    $day = 17;
    $prevMonth = date('m') - 1;
    $nextMonth = date('m') + 1;

    if(isset($_POST['paystub']))
    {
        echo("Maybe here");
        if ($day > 0 && $day < 15)
        {
            $prevPayStart = '2020-'.$prevMonth.'-15';
            $prevPayEnd = '2020-'.$month.'-01';
            $dateQuery = "SELECT total_worked FROM timesheet where date BETWEEN '$prevPayStart' AND '$prevPayEnd' AND username = 'rpura';";
            $result = $db->query($dateQuery);
            
            while ($row = $result->fetch_assoc())
            {
                $totalHrs += $row['total_worked'];
            }

        }
        else if ($day > 15 && '2020-'.date('m').'-'.$day < "2020-".$nextMonth."-01")
        {
            $prevPayStart = date('Y-m').'-01';
            $prevPayEnd = date('Y-m').'-15';
            $dateQuery = "SELECT total_worked FROM timesheet where date BETWEEN '$prevPayStart' AND '$prevPayEnd' AND username = 'rpura';";
            $result = $db->query($dateQuery);
            

            while ($row = $result->fetch_assoc())
            {
                $totalHrs += $row['total_worked'];
            }

        }

        $pay = $totalHrs * 15.00;

        $result = array('payPeriodStart' => $prevPayStart, 'payPeriodEnd' => $prevPayEnd, 'pay' => $pay);
        echo($result['payPeriodStart']);

        print json_encode([
            'success' => true,
            'data' => $result
            ]);
    }
} catch(Exception $e) {
    print json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

?>

