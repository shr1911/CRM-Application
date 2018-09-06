<?php

require 'db_connect.php';

$save_message_other = "";
$save_message_bday = "";
$save_message_anni = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'db_connect.php';

    $event_type = $_POST['event_type'];

    $save_message_other = "";
    $save_message_bday = "";
    $save_message_anni = "";

    if ($event_type == 'other_event') {
        $e_name = $_POST['event_name'];
        $event_type = $_POST['event_type'];
        $e_date = $_POST['event_date'];
        $e_msg = $_POST['event_msg'];
        $e_is_edited = $_POST['is_event_edited'];
        $edited_event_id = NULL;
        if ($e_is_edited == 'true') {
            $edited_event_id = $_POST['edited_event_id'];
        }
    
        if (strlen($e_name) > 0 && strlen($e_msg) > 0) {
            $e_date = date("Y-m-d", strtotime($e_date));
            if ($conn) {
                $e_name = quote_smart($e_name, $conn);
                $e_date = quote_smart($e_date, $conn);
                $e_msg = quote_smart($e_msg, $conn);

                if ($e_is_edited == 'true') {
                    $SQL = "UPDATE scheduled_events set e_date=" . $e_date . ",e_name=" . $e_name . ",e_message=" . $e_msg . " WHERE e_id='" . $edited_event_id . "'";
                    
                }
                else {
                    $SQL = "INSERT INTO scheduled_events (e_name, e_message, e_date) VALUES (" . $e_name . "," . $e_msg . "," . $e_date . ")";
                }
                $result = mysqli_query($conn, $SQL);
                $save_message_other = get_save_message($result);

                mysqli_close($conn);
            }
        } else {
            $save_message_other = "Event name or message can not be empty.";
        }
        $response_array['status'] = 'success';
        echo $save_message_other;
        
    } else if ($event_type == 'birthday') {
        $e_msg = $_POST['event_msg'];

        if (strlen($e_msg) > 0) {
            if ($conn) {
                $e_msg = quote_smart($e_msg, $conn);
                $SQL = "SELECT * FROM fixed_events WHERE e_name='birthday'";
                $result = mysqli_query($conn, $SQL);
                if (mysqli_num_rows($result) > 0) {
                    $SQL = "UPDATE fixed_events SET e_message = " . $e_msg . " WHERE e_name='birthday'";
                    $result = mysqli_query($conn, $SQL);

                    $save_message_bday = get_save_message($result);
                } else {
                    $SQL = "INSERT INTO fixed_events (e_name, e_message) VALUES ('birthday'," . $e_msg . ")";

                    $result = mysqli_query($conn, $SQL);

                    $save_message_bday = get_save_message($result);
                }
            }
        } else {
            $save_message_bday = "Event message can not be empty.";
        }
        echo $save_message_bday;
    } else if ($event_type == 'anniversary') {
        $e_msg = $_POST['event_msg'];

        if (strlen($e_msg) > 0) {
            if ($conn) {
                $e_msg = quote_smart($e_msg, $conn);
                $SQL = "SELECT * FROM fixed_events WHERE e_name='anniversary'";
                $result = mysqli_query($conn, $SQL);
                if (mysqli_num_rows($result) > 0) {
                    $SQL = "UPDATE fixed_events SET e_message = " . $e_msg . " WHERE e_name='anniversary'";
                    $result = mysqli_query($conn, $SQL);

                    $save_message_anni = get_save_message($result);
                } else {
                    $SQL = "INSERT INTO fixed_events (e_name, e_message) VALUES ('anniversary'," . $e_msg . ")";
                    $result = mysqli_query($conn, $SQL);

                    $save_message_anni = get_save_message($result);
                }
            }
        } else {
            $save_message_anni = "Event message can not be empty.";
        }
        echo $save_message_anni;
    }
}

function get_save_message($result) {
    if ($result == 'true') {
        return 'Event saved successfully.';
    } else {
        return 'Error while saving the event.';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $event_type = $_GET['event_type'];
    if ($event_type == 'birthday') {
        echo get_bday_message($conn);
    } else if ($event_type == 'anniversary') {
        echo get_anni_message($conn);
    }
}

function get_bday_message($conn) {
    if ($conn) {
        $SQL = "SELECT e_message FROM fixed_events WHERE e_name='birthday'";
        $result = mysqli_query($conn, $SQL);
        $rows = mysqli_fetch_all($result, MYSQLI_NUM);
        if (mysqli_num_rows($result) > 0) {
            return $rows[0][0];
        } else {
            return "";
        }
    }
}

function get_anni_message($conn) {
    $SQL = "SELECT e_message FROM fixed_events WHERE e_name='anniversary'";
    $result = mysqli_query($conn, $SQL);
    $rows = mysqli_fetch_all($result, MYSQLI_NUM);
    if (mysqli_num_rows($result) > 0) {
        return $rows[0][0];
    } else {
        return "";
    }
}

//Removing escape chars to insert into db
function quote_smart($value, $conn) {
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }

    if (!is_numeric($value)) {
        $value = "'" . mysqli_real_escape_string($conn, $value) . "'";
    }
    return $value;
}

?>
