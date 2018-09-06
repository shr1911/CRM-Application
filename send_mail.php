<?php

require 'db_connect.php';

date_default_timezone_set('Asia/Kolkata');

$todaydate = date("Y-m-d");
echo "Today is " . $todaydate . "<br>";
//echo "Today is " . date("l");
//echo gettype($todaydate);
//$year = date('Y', strtotime($todaydate));

$todaymonth = date('m', strtotime($todaydate));

$todayday = date('d', strtotime($todaydate));



$sql_birthday = "SELECT * FROM contacts WHERE birthday LIKE '%-" . $todaymonth . "-" . $todayday . "'";
$sql_anniversary = "SELECT * FROM contacts WHERE anniversary LIKE '%-" . $todaymonth . "-" . $todayday . "'";
$sql_otherEvents = "SELECT * FROM scheduled_events WHERE e_date LIKE '%-" . $todaymonth . "-" . $todayday . "'";


$result_birthday = mysqli_query($conn, $sql_birthday);
$result_anniversary = mysqli_query($conn, $sql_anniversary);
$result_otherEvents = mysqli_query($conn, $sql_otherEvents);


$num_rows_birthday = mysqli_num_rows($result_birthday);
$num_rows_anniversary = mysqli_num_rows($result_anniversary);
$num_rows_otherEvents = mysqli_num_rows($result_otherEvents);

if ($num_rows_birthday > 0 || $num_rows_anniversary > 0) {
    $sql_fixed_messages = "SELECT * FROM fixed_events";
    $result_fixed_messages = mysqli_query($conn, $sql_fixed_messages);
    $fixed_events_array = mysqli_fetch_all($result_fixed_messages, MYSQLI_NUM);

    if ($num_rows_birthday > 0) {
        $msg = $fixed_events_array['0']['2'];

        //$msg = "Many many happy returns of the day! testing";
        // the message
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);
        $rows = mysqli_fetch_all($result_birthday, MYSQLI_NUM);

        foreach ($rows as $onerow) {
            if ($onerow['6'] != NULL) {
                //mail($onerow['6'], "Test Mail", $msg);
                echo "Email- " . $onerow['6'] . "     Msg- " . $msg . "<br/>";
            }
        }

        // $to = "shraddha.mak1911@gmail.com, hemal0105@gmail.com";
        // send email
    }



    if ($num_rows_anniversary > 0) {

        $msg = $fixed_events_array['1']['2'];

        //$msg = "Happy Marriage Anniversary! testing";
        // the message
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);
        $rows = mysqli_fetch_all($result_anniversary, MYSQLI_NUM);

        echo "<br/>";
        foreach ($rows as $onerow) {
            if ($onerow['6'] != NULL) {
                //mail($onerow['6'], "Test Mail", $msg);
                echo "Email- " . $onerow['6'] . "     Msg- " . $msg . "<br/>";
            }
        }

        // $to = "shraddha.mak1911@gmail.com, hemal0105@gmail.com";
        // send email
    }
}

if ($num_rows_otherEvents > 0) {

    $sql_allContacts = "SELECT * FROM contacts";
    $result_allContacts = mysqli_query($conn, $sql_allContacts);
    $allContacts_array = mysqli_fetch_all($result_allContacts, MYSQLI_NUM);

    $otherEvents_array = mysqli_fetch_all($result_otherEvents, MYSQLI_NUM);
    $msg = $otherEvents_array['0']['2'];


    echo "<br/>";
    foreach ($otherEvents_array as $oneEvent) {

        $msg = $oneEvent['2'];
        $msg = wordwrap($msg, 70);
        echo "<br/>";

        foreach ($allContacts_array as $oneContact) {
            if ($oneContact['6'] != NULL) {
                //mail($to, "Test Mail", $msg);
                echo "Email- " . $oneContact['6'] . "     Msg- " . $msg . "<br/>";
            }
        }

        // $to = "shraddha.mak1911@gmail.com, hemal0105@gmail.com";
        // send email
    }
}
?>