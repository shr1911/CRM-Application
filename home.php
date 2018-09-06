<?PHP
require 'db_connect.php';
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: usermodule/login.php");
}
?>
<html>
    <head>
        <title>Hari Om Jyotish</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
        <!-- Bootstrap -->
        <link href="Bootstrap-Admin-Theme-3-master/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="Bootstrap-Admin-Theme-3-master/css/styles.css" rel="stylesheet">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href="Bootstrap-Admin-Theme-3-master/vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
        <link href="Bootstrap-Admin-Theme-3-master/vendors/select/bootstrap-select.min.css" rel="stylesheet">
        <link href="Bootstrap-Admin-Theme-3-master/vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

        <link href="Bootstrap-Admin-Theme-3-master/css/forms.css" rel="stylesheet">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- jQuery UI -->
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="Bootstrap-Admin-Theme-3-master/bootstrap/js/bootstrap.min.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/vendors/form-helpers/js/bootstrap-formhelpers.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/vendors/select/bootstrap-select.min.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/vendors/tags/js/bootstrap-tags.min.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/vendors/mask/jquery.maskedinput.min.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/vendors/moment/moment.min.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

        <!-- bootstrap-datetimepicker -->
        <link href="Bootstrap-Admin-Theme-3-master/vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
        <script src="Bootstrap-Admin-Theme-3-master/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 

        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

        <script src="Bootstrap-Admin-Theme-3-master/js/custom.js"></script>
        <script src="Bootstrap-Admin-Theme-3-master/js/forms.js"></script>

        <script>
            var isEdited = false;
            var editedEventId = null;
            var deletedEventId = null;

            window.onload = function () {

                document.getElementById("add-edit-event").style.display = "block";
                document.getElementById("event-list").style.display = "none";

                $.ajax({
                    type: "GET",
                    url: "home_action.php",
                    data: "event_type=birthday",
                    cache: false,
                    success: function (html) {
                        document.getElementsByName("event_msg_bday")[0].value = html;
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "home_action.php",
                    data: "event_type=anniversary",
                    cache: false,
                    success: function (html) {
                        document.getElementsByName("event_msg_anni")[0].value = html;
                    }
                });
            };


            function submitOtherEvents() {
                var event_name = document.getElementsByName("event_name")[0].value;
                var event_date = document.getElementsByName("event_date")[0].value;
                var event_msg = document.getElementsByName("event_msg_other")[0].value;
                var dataString = '';




                if (event_name === '' || event_date === '' || event_msg === '') {
                    alert("Please Fill All Fields");
                } else {
                    dataString = 'event_msg=' + event_msg + '&event_type=other_event';
                    dataString += '&event_name=' + event_name + '&event_date=' + event_date;
                    if (isEdited) {
                        dataString += '&is_event_edited=true';
                        dataString += '&edited_event_id=' + editedEventId;
                    } else {
                        dataString += '&is_event_edited=false';
                    }
                    isEdited = false;

                    if (dataString.length > 0) {
                        $.ajax({
                            type: "POST",
                            url: "home_action.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                console.log("ajax res" + html);
                                alert(html);
                            }, error: function (html) {
                                console.log("ajax res error" + html);
                                alert(html);
                            }
                        });
                    }
                    return false;
                }
            }

            function submitBdyMsg() {
                var event_msg = document.getElementsByName("event_msg_bday")[0].value;
                var dataString = '';

                if (event_msg === '') {
                    alert("Please Fill All Fields");
                } else {
                    dataString = 'event_msg=' + event_msg + '&event_type=birthday';

                    if (dataString.length > 0) {
                        $.ajax({
                            type: "POST",
                            url: "home_action.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                alert(html);
                            }
                        });
                    }
                    return false;
                }
            }

            function submitAnniMsg() {
                var event_msg = document.getElementsByName("event_msg_anni")[0].value;
                var dataString = '';


                if (event_msg === '') {
                    alert("Please Fill All Fields");
                } else {
                    dataString = 'event_msg=' + event_msg + '&event_type=anniversary';

                    if (dataString.length > 0) {
                        $.ajax({
                            type: "POST",
                            url: "home_action.php",
                            data: dataString,
                            cache: false,
                            success: function (html) {
                                alert(html);
                            }
                        });
                    }
                    return false;
                }
            }

            var eventToggleFlag = true;

            function eventToggle() {
                //document.getElementById("add-edit-event").style.visibility = "hidden";
                //document.getElementById("event-list").style.visibility = "visible";
                if (eventToggleFlag) {
                    document.getElementById("add-edit-event").style.display = "none";
                    document.getElementById("event-list").style.display = "block";
                    eventToggleFlag = false;
                } else {
                    document.getElementById("add-edit-event").style.display = "block";
                    document.getElementById("event-list").style.display = "none";
                    eventToggleFlag = true;
                }
            }

            function eventEdit(id) {
                eventToggle();
                document.getElementsByName('event_name')[0].value = document.getElementById('elist-name-' + id).innerHTML;
                document.getElementsByName('event_msg_other')[0].value = document.getElementById('elist-message-' + id).value;
                document.getElementsByName('event_date')[0].value = document.getElementById('elist-date-' + id).innerHTML;
                //alert(document.getElementsByName('event_date')[0].value);
                isEdited = true;
                editedEventId = id;
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
                            <h1><a href="home.php">Hari Om Jyotish</a></h1>
                        </div>
                    </div><!--
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Search</button>
                                    </span>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <li><a href="profile.html">Profile</a></li>
                                            <li><a href="login.html">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <li class="current"><a href="home.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                            <li><a href="contacts/fetch_gmail_contacts.php"><i class="glyphicon glyphicon-refresh"></i> Refresh Contacts</a></li>
                            <li><?php
                                if ($_SESSION['login'] == "'shraddha.mak1911@gmail.com'") {
                                    echo '<a href = usermodule/signup.php><i class="glyphicon glyphicon-user"></i>New User</a>';
                                    echo '<br/>';
                                }
                                ?>
                            </li>
                            <li><a href="contacts/contact_list.php"><i class="glyphicon glyphicon-list"></i> Contacts List</a></li>
                            <li><a href="usermodule/change_password.php"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                            <li><a href="usermodule/logout.php"><i class="glyphicon glyphicon-log-out"></i> Log out</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content-box-header">

                                <div class="panel-title">Add Other Events</div>

                                <div class="panel-options">
                                    <a href="javascript:void(0);" data-rel="collapse" onclick="eventToggle();" style="text-decoration: none;color: black" title="Event List"><i class="glyphicon glyphicon-list-alt"></i></a>
                                    <!--<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
                                </div>
                            </div>

                            <div class="content-box-large box-with-header" id="add-edit-event">
                                <div class="panel-body">
                                    <div>
                                        <fieldset>
                                            <div class="form-group">
                                                <label>Event Name</label>
                                                <input class="form-control" placeholder="Please add event name..." type="text" name="event_name">
                                            </div>
                                            <div class="form-group">
                                                <label>Select Date</label>
                                                <p>
                                                <div class="bfh-datepicker" data-format="y-m-d" data-date="today" name="event_date_div"></div>
                                                </p>
                                            </div>
                                            <div class="form-group">
                                                <label>Event message</label>
                                                <textarea class="form-control" placeholder="Please add event message..." rows="6" name="event_msg_other"></textarea>
                                            </div>
                                        </fieldset>
                                        <div class="form-group" style="float: left">
                                            <button onclick="submitOtherEvents()" type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                        <div style="float: left; margin:8px 0 0 10px">
                                            <p>  </p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if (mysqli_connect_errno()) {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }

                            $sql = "SELECT * FROM scheduled_events";
                            $result = mysqli_query($conn, $sql);

                            $rows = mysqli_fetch_all($result, MYSQLI_NUM);


                            mysqli_close($conn);
                            ?>




                            <div class="content-box-large box-with-header" id="event-list">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>EventName
                                            </th>
                                            <th>Date</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>

                                        </tr>
                                    </thead>

                                    <?php
                                    $strtable = "<tbody>";
                                    foreach ($rows as $onerow) {
                                        $strtable .= "<tr>"
                                                . "<td><div id='elist-name-" . $onerow[0] . "'>" . $onerow['1'] . "</div></td>"
                                                . "<td><div id='elist-date-" . $onerow[0] . "'>" . $onerow['3'] . "</div></td>"
                                                . "<td>"
                                                . "<a id='" . $onerow['0'] . "' href='javascript:void(0);' data-rel='collapse' onclick='eventEdit(this.id);' style='text-decoration: none;color: black' title='Edit'><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;&nbsp;&nbsp;"
                                                . "<a id='" . $onerow['0'] . "' href='javascript:void(0);' data-rel='collapse' style='text-decoration: none;color: black' title='Delete'><i class='glyphicon glyphicon-trash'></i></a>&nbsp;&nbsp;&nbsp;"
                                                . "<td><i class='glyphicon glyphicon-ok'></i></td>"
                                                . "<input type='hidden' id='elist-message-" . $onerow[0] . "' value='" . $onerow[2] . "'/>"
                                                . "</td>"
                                                . "</tr>";
                                    }
                                    echo $strtable;
                                    ?>


                                       <!-- <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td><i class="glyphicon glyphicon-pencil" title="Edit"></i>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-trash" title="Delete"></i>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-ok" title="Delete"></i></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td><i class="glyphicon glyphicon-pencil" title="Edit"></i>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-trash" title="Delete"></i>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-ok" title="Delete"></i></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td><i class="glyphicon glyphicon-pencil" title="Edit"></i>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-trash" title="Delete"></i>&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-ok" title="Delete"></i></td>
                                    -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="content-box-header">
                                        <div class="panel-title">Birthday</div>

                                        <div class="panel-options">
                                            <!--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                                            <a href = "#" data-rel = "reload"><i class = "glyphicon glyphicon-cog"></i></a> -->
                                        </div>
                                    </div>
                                    <div class = "content-box-large box-with-header">
                                        <div class = "panel-body" style = "padding: 10px 15px 10px 15px;">
                                            <div>
                                                <fieldset>
                                                    <div class = "form-group">
                                                        <label>Birthday message</label>
                                                        <textarea class = "form-control" placeholder = "Please add birthday message..." rows = "4" name = "event_msg_bday"></textarea>

                                                    </div>
                                                </fieldset>
                                                <div class = "form-group" style = "float: left">
                                                    <button onclick = "submitBdyMsg()" type = "submit" class = "btn btn-primary">Save</button>
                                                </div>
                                                <div style = "float: left; margin:8px 0 0 10px">
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class = "row">
                                <div class = "col-md-12">
                                    <div class = "content-box-header" >
                                        <div class = "panel-title">Anniversary</div>

                                        <div class = "panel-options">
                                        <!--<a href = "#" data-rel = "collapse"><i class = "glyphicon glyphicon-refresh"></i></a>
                                        <a href = "#" data-rel = "reload"><i class = "glyphicon glyphicon-cog"></i></a> -->
                                        </div>
                                    </div>
                                    <div class = "content-box-large box-with-header">
                                        <div class = "panel-body" style = "padding: 10px 15px 10px 15px;">
                                            <div>
                                                <fieldset>
                                                    <div class = "form-group">
                                                        <label>Anniversary message</label>
                                                        <textarea class = "form-control" placeholder = "Please add anniversary message..." rows = "4" name = "event_msg_anni"></textarea>
                                                    </div>
                                                </fieldset>
                                                <div class = "form-group" style = "float: left">
                                                    <button onclick = "submitAnniMsg()" type = "submit" class = "btn btn-primary">Save</button>
                                                </div>
                                                <div style = "float: left; margin:8px 0 0 10px">
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->

    </body>
</html>