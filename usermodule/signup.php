<?PHP
require '../db_connect.php';

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: login.php");
}

//set the session variable to 1, if the user signs up. That way, they can use the site straight away
//do you want to send the user a confirmation email?
//does the user need to validate an email address, before they can use the site?
//do you want to display a message for the user that a particular username is already taken?
//test to see if the u and p are long enough
//you might also want to test if the users is already logged in. That way, they can't sign up repeatedly without closing down the browser
//other login methods - set a cookie, and read that back for every page
//collect other information: date and time of login, ip address, etc
//don't store passwords without encrypting them

$uname = "";
$pword = "";
$errorMessage = "";
$num_rows = 0;

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

    //====================================================================
    //	GET THE CHOSEN U AND P, AND CHECK IT FOR DANGEROUS CHARCTERS
    //====================================================================
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    $uname = htmlspecialchars($uname);
    $pword = htmlspecialchars($pword);

    //====================================================================
    //	CHECK TO SEE IF U AND P ARE OF THE CORRECT LENGTH
    //	A MALICIOUS USER MIGHT TRY TO PASS A STRING THAT IS TOO LONG
    //	if no errors occur, then $errorMessage will be blank
    //====================================================================

    $uLength = strlen($uname);
    $pLength = strlen($pword);

    if ($uLength >= 5 && $uLength <= 20) {
        $errorMessage = "";
    } else {
        $errorMessage = $errorMessage . "Username must be between 5 and 20 characters" . "<BR>";
    }

    if ($pLength >= 8 && $pLength <= 16) {
        $errorMessage = "";
    } else {
        $errorMessage = $errorMessage . "Password must be between 8 and 16 characters" . "<BR>";
    }


//test to see if $errorMessage is blank
//if it is, then we can go ahead with the rest of the code
//if it's not, we can display the error
    //====================================================================
    //	Write to the database
    //====================================================================
    if ($errorMessage == "") {
        //$conn = mysql_select_db($database, $conn);

        if ($conn) {

            $uname = quote_smart($uname, $conn);
            $pword = quote_smart($pword, $conn);

            //====================================================================
            //	CHECK THAT THE USERNAME IS NOT TAKEN
            //====================================================================

            $SQL = "SELECT * FROM user WHERE email = $uname";
            $result = mysqli_query($conn, $SQL);
            $num_rows = mysqli_num_rows($result);

            if ($num_rows > 0) {
                $errorMessage = "Username already taken";
            } else {
                echo $uname;

                $SQL = "INSERT INTO user (email, password) VALUES ($uname, $pword)";

                $result = mysqli_query($conn, $SQL);

                mysqli_close($conn);
                /*
                  session_start();
                  $_SESSION['login'] = $uname;
                 */
                header("Location: login.php");
            }
        } else {
            $errorMessage = "Database Not Found";
        }
    }
}
?>
<html>
    <head>
        <title>Add new user</title>
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
                                <h6>Add new user</h6>
                                <FORM NAME ="form1" METHOD ="POST" ACTION ="signup.php">

                                    <INPUT class="form-control" TYPE = 'TEXT' Name ='username'  value="<?PHP print $uname; ?>" maxlength="20" placeholder="E-mail Address">
                                    <INPUT class="form-control" TYPE = 'TEXT' Name ='password'  value="<?PHP print $pword; ?>" maxlength="16" placeholder="Password">
                                 
                                    <P>
                                        <INPUT class="btn btn-primary signup" TYPE = "Submit" Name = "Submit1"  VALUE = "Register">
                                </FORM>
                                <button style='margin-left: 10px;' class = 'btn btn-success'><a style='text-decoration: none;color: white' href='../home.php'>HOME </a></button>
                                <br/>
                                 <?PHP print $errorMessage; ?>
                                <P>
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

