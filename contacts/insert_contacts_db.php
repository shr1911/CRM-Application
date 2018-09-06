<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require 'delete_contacts_db.php';

        delete_prev_contacts();

        function insert_refreshed_contacts($response) {
            require '../db_connect.php';

            //$google_contacts_string = file_get_contents("C:\wamp64\www\ContactsDemo\output.json");
            $google_contacts = json_decode($response, true)['feed']['entry'];

            $contacts = array();


            if (!empty($google_contacts)) {
                foreach ($google_contacts as $contact) {
                    $anniversary = NULL;
                    if (!empty($contact['gContact$event'])) {
                        foreach ($contact['gContact$event'] as $event) {
                            if ($event['rel'] == 'anniversary') {
                                $anniversary = $event['gd$when']['startTime'];
                            }
                        }
                    }

                    $phones = array();
                    if (!empty($contact['gd$phoneNumber'])) {
                        $i = 0;
                        foreach ($contact['gd$phoneNumber'] as $phone) {
                            //trim($phone['$t'],"<br/>");
                            $phones[$i++] = $phone['$t'];
                        }
                    }

                    $emails = array();
                    if (!empty($contact['gd$email'])) {
                        $i = 0;
                        foreach ($contact['gd$email'] as $email) {
                            $emails[$i++] = $email['address'];
                        }
                    }

                    $birthday = NULL;
                    if (!empty($contact['gContact$birthday'])) {
                        $birthday = $contact['gContact$birthday']['when'];
                    }

                    $fullName = NULL;
                    $givenName = NULL;
                    $familyName = NULL;

                    if (!empty($contact['gd$name'])) {
                        if (!empty($contact['gd$name']['gd$fullName'])) {
                            $fullName = $contact['gd$name']['gd$fullName']['$t'];
                        }
                        if (!empty($contact['gd$name']['gd$givenName'])) {
                            $givenName = $contact['gd$name']['gd$givenName']['$t'];
                        }
                        if (!empty($contact['gd$name']['gd$familyName'])) {
                            $familyName = $contact['gd$name']['gd$familyName']['$t'];
                        }
                    }


                    $contacts[] = array(
                        'title' => $contact['title']['$t'],
                        'fullName' => $fullName,
                        'givenName' => $givenName,
                        'familyName' => $familyName,
                        'phone' => $phones,
                        'email' => $emails,
                        'birthday' => $birthday,
                        'anniversary' => $anniversary,
                    );
                }
            }

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            function clean($conn, $str) {
                $str = trim($str);
                if (get_magic_quotes_gpc()) {
                    $str = stripslashes($str);
                }
                return mysqli_real_escape_string($conn, $str);
            }

            $valuesArr = array();

            $sql = "INSERT INTO contacts (
                title, 
                fullName, 
                givenName, 
                familyName, 
                phone, 
                email, 
                birthday, 
                anniversary
                )
            VALUES ";




            foreach ($contacts as $contact) {
                $phones = NULL;
                foreach ($contact['phone'] as $phone) {
                    $phones .= $phone;
                }

                $emails = NULL;
                foreach ($contact['email'] as $email) {
                    $emails .= $email;
                }
                //Sanitize the POST values

                $mysql_title = mysqli_real_escape_string($conn, $contact['title']);
                $mysql_fullName = mysqli_real_escape_string($conn, $contact['fullName']);
                $mysql_givenName = mysqli_real_escape_string($conn, $contact['givenName']);
                $mysql_familyName = mysqli_real_escape_string($conn, $contact['familyName']);
                $mysql_birthday = mysqli_real_escape_string($conn, $contact['birthday']);
                $mysql_anniversary = mysqli_real_escape_string($conn, $contact['anniversary']);

                $valuesArr[] = "('$mysql_title', '$mysql_fullName', '$mysql_givenName', '$mysql_familyName','$phones','$emails','$mysql_birthday','$mysql_anniversary')";
            }

            $sql .= implode(',', $valuesArr);
            mysqli_query($conn, $sql) or exit(mysqli_error($conn));
            $result = mysqli_affected_rows($conn);
            $conn->close();
            
            return $result;
        }
        ?>
    </body>
</html>
