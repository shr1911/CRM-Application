<?PHP
session_start();
session_destroy();
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
                            <h1><a href="login.php">Hari Om Jyotish</a></h1>
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
                                <h5>You are successfully logged out.</h5><br/>
                                 <button class="btn btn-primary"><A style='text-decoration: none;color: white' HREF = login.php>Login Again</A></button>
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