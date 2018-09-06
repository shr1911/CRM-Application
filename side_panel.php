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
                                    echo '<a href = usermodule/signup.php><i class="glyphicon glyphicon-user"></i>New User</A>';
                                    echo '<br/>';
                                }
                                ?>
                            </li>
                            <li><a href="contacts/contact_list.php"><i class="glyphicon glyphicon-list"></i> Contacts List</a></li>
                            <li><a href="buttons.html"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                            <li><a href="usermodule/logout.php"><i class="glyphicon glyphicon-log-out"></i> Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!--jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->

    </body>
</html> 
