<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
session_start();
require_once realpath(dirname(__FILE__) . '/google-api-php-client/src/Google/autoload.php');


$client_id = "815774003845-giskte1q30ttq6n0a6afeahuqhhju8uj.apps.googleusercontent.com";
$client_secret = "p74XJyPHpuaAWtBWAtqNof53";
$scriptUri = "http://hariomjyotish.com" . $_SERVER['PHP_SELF'];
$redirect_uri = $scriptUri;

/* * **********************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 * ********************************************** */
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.google.com/m8/feeds");

/* * **********************************************
  A general service created
 * ********************************************** */

/* * **********************************************
  Boilerplate auth management - see
  user-example.php for details.
 * ********************************************** */
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    $authUrl = $client->createAuthUrl();
}

/* * **********************************************
  If we're signed in, retrieve contacts
 * ********************************************** */
if ($client->getAccessToken()) {
    $max_results = 999;
    $_SESSION['access_token'] = $client->getAccessToken();

    $access_token = json_decode($client->getAccessToken())->access_token;
    //echo $access_token."<br/><br/>";
    //$url = 'https://www.google.com/m8/feeds/contacts/default/full?alt=json&v=3.0&oauth_token='.$access_token;
    $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results=' . $max_results . '&alt=json&v=3.0&oauth_token=' . $access_token;
    $response = file_get_contents($url);
}

if ($client_id == '<YOUR_CLIENT_ID>' || $client_secret == '<YOUR_CLIENT_SECRET>' || $redirect_uri == '<YOUR_REDIRECT_URI>') {
    echo missingClientSecretsWarning();
}
?>
<html>
    <head>
        <title>Refresh Contacts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../Bootstrap-Admin-Theme-3-master/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="../Bootstrap-Admin-Theme-3-master/css/styles.css" rel="stylesheet">
    </head>

    <body class="login-bg">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="../home.php">Hari Om Jyotish</a></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-wrapper">
                        <div class="box">
                            <a style="text-decoration: none; color: white"></a>
                            <div class="content-wrap">
                                <h6 style="margin-bottom: 22px;">Refresh Contacts</h6>
                                <?php
                                if (isset($authUrl) && $authUrl != NULL) {
                                    echo '<p style="font-size: 14px;">Are you sure you want to refresh the database contacts?';
                                    echo "<br/><br/><button class = 'btn btn-success btn-sm'><a style='text-decoration: none;color: white' href='" . $authUrl . "'>Yes</a></button>";
                                    echo "<button style='margin-left: 10px;' class = 'btn btn-danger btn-sm'><a style='text-decoration: none;color: white' href='../home.php'>No </a></button>";
                                   
                                } else {
                                    //$j = json_decode($response);
                                    //file_put_contents('C:\wamp64\www\ContactsDemo\output.json', $response);
                                    //header("Location: insert_contacts_db.php");
                                    require_once './insert_contacts_db.php';
                                    insert_refreshed_contacts($response);
                                    unset($_SESSION['access_token']);
                                    $authUrl = NULL;
                                    header('Location: contact_list.php');
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../Bootstrap-Admin-Theme-3-master/bootstrap/js/bootstrap.min.js"></script>
        <script src="../Bootstrap-Admin-Theme-3-master/js/custom.js"></script>


        <!--<FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">
    
            Username: <INPUT TYPE = 'TEXT' Name ='username'  value="shraddha.mak1911@gmail.com" maxlength="50">
            Password: <INPUT TYPE = 'TEXT' Name ='password'  value="123456789" maxlength="10">
    
            <P align = center>
                <INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
            </P>
    
        </FORM>
        -->
        <P>





    </body>
</html>