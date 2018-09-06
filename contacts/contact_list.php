<?PHP
require '../db_connect.php';
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: usermodule/login.php");
}
?>
<html>
    <head>
        <title>Contact List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- jQuery UI -->
        <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

        <!-- Bootstrap -->
        <link href="../Bootstrap-Admin-Theme-3-master/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="../Bootstrap-Admin-Theme-3-master/css/styles.css" rel="stylesheet">

        <script>
            function myFunction(id) {
                var cboxStatus = document.getElementById(id).checked;
                alert("cboxStatus: " + cboxStatus + " id: " + id);

                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.open("GET", "update_status.php?status=" + cboxStatus + "&id=" + id, true);
                xmlhttp.send();


            }
        </script>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="../home.php">Hari Om Jyotish</a></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <li class="current"><a href="../home.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                            <li><a href="fetch_gmail_contacts.php"><i class="glyphicon glyphicon-refresh"></i> Refresh Contacts</a></li>
                            <li><?php
                                if ($_SESSION['login'] == "'shraddha.mak1911@gmail.com'") {
                                    echo '<a href = ../usermodule/signup.php><i class="glyphicon glyphicon-user"></i> New User </A>';
                                    echo '<br/>';
                                }
                                ?>
                            </li>
                            <li><a href="contact_list.php"><i class="glyphicon glyphicon-list"></i> Contacts List</a></li>
                            <li><a href="../usermodule/change_password.php"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                            <li><a href="../usermodule/logout.php"><i class="glyphicon glyphicon-log-out"></i> Log out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <h2>Contacts List</h2>
                        </div>
                        <div class="panel-body">

                            <?php
                            $sql = "SELECT * FROM contacts";
                            $result = mysqli_query($conn, $sql);
                            
                            $num_rows = mysqli_num_rows($result);
                            echo "<h5>Current Available Contacts : ".$num_rows." </h5>";
                            
                          
                            $rows = mysqli_fetch_all($result, MYSQLI_NUM);

                            $str_table = "<table style='font-size: 12px;' cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' >"
                                    . "<thead>"
                                    . "<tr><th>&nbsp</th>"
                                    . "<th>Name</th> "
                                    //. "<th>fullName</th>"
                                    //. "<th>givenName</th> "
                                    //. "<th>familyName</th> "
                                    . "<th>phone</th> "
                                    . "<th>email</th> "
                                    . "<th>birthday</th> "
                                    . "<th>anniversary</th>"
                                    . "</tr>"
                                    . "</thead>";

                            $str_table .= "<tbody>";
                            foreach ($rows as $onerow) {
                                //foreach ($row as $onerow)
                                if ($onerow['9'] == 1) {
                                    $checkbox_html = "<input checked type='checkbox' name='status' id='" . $onerow['0'] . "' onchange='myFunction(this.id)'>";
                                } else {
                                    $checkbox_html = "<input type='checkbox' name='status' id='" . $onerow['0'] . "' onchange='myFunction(this.id)'>";
                                }

                                $str_table .= "<tr class='gradeX'>"
                                        . "<td>" . $checkbox_html . "</td>"
                                        . "<td>" . $onerow['1'] . " </td>"
                                        //. "<td>" . $onerow['2'] . " </td>"
                                        //. "<td>" . $onerow['3'] . " </td>"
                                        //. "<td>" . $onerow['4'] . " </td>"
                                        . "<td>" . $onerow['5'] . " </td>"
                                        . "<td>" . $onerow['6'] . " </td>"
                                        . "<td>" . $onerow['7'] . " </td>"
                                        . "<td>" . $onerow['8'] . " </td>"
                                        . "</tr>";
                            }

                            $str_table .= "</tbody></table>";
                            echo $str_table;
                            mysqli_free_result($result);

                            mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <link href="../Bootstrap-Admin-Theme-3-master/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- jQuery UI -->
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../Bootstrap-Admin-Theme-3-master/bootstrap/js/bootstrap.min.js"></script>

        <script src="../Bootstrap-Admin-Theme-3-master/vendors/datatables/js/jquery.dataTables.min.js"></script>

        <script src="../Bootstrap-Admin-Theme-3-master/vendors/datatables/dataTables.bootstrap.js"></script>

        <script src="../Bootstrap-Admin-Theme-3-master/js/custom.js"></script>
        <script src="../Bootstrap-Admin-Theme-3-master/js/tables.js"></script>
    </body>
</html>
