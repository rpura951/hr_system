<?php

function data_entry($db, $un, $today, $option) {
    $time = date('H:i:s');
    try{
        if($option == 'start'){   
        //new data table entry 
        $new_entry = "INSERT INTO timesheet (date, start, username, end, lunch_in, lunch_out, total_worked)
                    VALUES ('$today', '$time', '$un', '00:00:00', '00:00:00', '00:00:00', 0)";
        $result = $db->query($new_entry);

        if (!$result)
        {
            throw new Exception("User unable to clock in.");
        }

        }
        else {
            // update time for a table variable
            $update_entry = "UPDATE timesheet SET {$option} = '$time' WHERE username = '$un' AND date = '$today'";
            $db->query($update_entry);

            //enter in total hours worked 
            if($option == 'end') 
            {
                $calcQuery = "Set @start = (SELECT start FROM timesheet WHERE username = '$un' AND date = '$today');";
                $db->query($calcQuery);
                $calcQuery = "SET @end = (SELECT end FROM timesheet WHERE username = '$un' AND date = '$today');";    
                $db->query($calcQuery);
                $calcQuery = "SET @lunchstart = (SELECT lunch_out FROM timesheet WHERE username = '$un' AND date = '$today');";    
                $db->query($calcQuery);
                $calcQuery = "SET @lunchend = (SELECT lunch_in FROM timesheet WHERE username = '$un' AND date = '$today');";    
                $db->query($calcQuery);
                $calcQuery = "SET @total = TIME_TO_SEC(TIMEDIFF(@end, @start))/3600 - TIME_TO_SEC(TIMEDIFF(@lunchend, @lunchstart))/3600;";
                $db->query($calcQuery);
                $calcQuery = "UPDATE timesheet SET total_worked = ROUND(@total,2) WHERE username = '$un' AND date = '$today';";
                $db->query($calcQuery);
            }
        }
    return $time;
    } catch Exception($e){
        $e->getMessage();
    }
    
}