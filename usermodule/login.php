<?PHP
require '../db_connect.php';

$uname = "root";
$pword = "";
$errorMessage = "";

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    $uLength = strlen($uname);
    $pLength = strlen($pword);

    if ($uLength > 0 && $pLength > 0) {
        $errorMessage = "";

        $uname = htmlspecialchars($uname);
        $pword = htmlspecialchars($pword);

        if ($conn) {

            $uname = quote_smart($uname, $conn);
            $pword = quote_smart($pword, $conn);

            $SQL = "SELECT * FROM user WHERE email = $uname AND password = $pword";
            $result = mysqli_query($conn, $SQL);
            $num_rows = mysqli_num_rows($result);

            //====================================================
            //	CHECK TO SEE IF THE $result VARIABLE IS TRUE
            //====================================================

            if ($result) {
                if ($num_rows > 0) {
                    session_start();
                    $_SESSION['login'] = $uname;
                    header("Location: ../home.php");
                } else {
                    session_start();
                    $_SESSION['login'] = "";
                    $errorMessage = "Invalid username or password!";
                }
            } else {
                $errorMessage = "Error logging on";
            }

            mysqli_close($conn);
        } else {
            $errorMessage = "Error logging on";
        }
    }else {
        $errorMessage = $errorMessage . "Please Enter Values!" . "<BR>";
    }
}
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
                                <h6>LogIn</h6>
                                <FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">
                                    <input class="form-control" type="text" name="username" placeholder="E-mail address" value="shraddha.mak1911@gmail.com">
                                    <input class="form-control" type="password" name="password" placeholder="Password" value="123456789">
                                    <div class="action">
                                        <INPUT class="btn btn-primary signup" TYPE = "Submit" Name = "Submit1"  VALUE = "Login">

                                    </div>
                                </FORM>
                                <br/>
                                  <?PHP print $errorMessage; ?>

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