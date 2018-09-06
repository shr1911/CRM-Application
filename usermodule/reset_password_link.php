<?php
require '../db_connect.php';


?>



<html>
    <head>
        <title>Basic Login Script</title>
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
                            <div class="content-wrap">
                                <h6>Enter New Password</h6>
                                <FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">
                                    <input class="form-control" type="password" name="password" placeholder="New Password">
                                    <input class="form-control" type="confirm_password" name="confirm_password" placeholder="Confirm New Password">
                                    <div class="action">
                                        <INPUT class="btn btn-primary signup" TYPE = "Submit" Name = "Submit1"  VALUE = "Submit">

                                    </div>
                                </FORM>
                                <br/>
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


