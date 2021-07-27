<?php
    session_start();

    if (isset($_POST['pass']) && isset($_POST['email'])){
        $pass = $_POST['pass'];
        $user = $_POST['email'];

        $salt = 'XyZzy12*_';
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        $check = hash('md5', $salt.$pass);

        if($pass === '' || $user === ''){
            $_SESSION['error'] = "User name and password are required\n";
            header("Location: login.php");
            return;
        } else if($check != $stored_hash){
            $_SESSION['error'] = "Incorrect password\n";;
            error_log("Login fail ".$user." $check");
            header("Location: login.php");
            return;
        } else if(strpos($user, '@') === false){
            $_SESSION['error'] = "Email must have an at-sign (@)\n";
            header("Location: login.php");
            return;
        } else{
            error_log("Login success ".$user);
            $_SESSION['name'] = $user;
            header("Location: index.php");
            return;
        }
    }
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Saad Makrod Sign In</title>

	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1>Please Sign In</h1>

    <p>Enter your username and password</p>

    
    <?php
        if(isset($_SESSION['error'])){
            echo "<p id='message'> ";
            echo htmlentities($_SESSION['error']);
            echo " </p>";
            unset($_SESSION['error']);
        }
    ?>
    
		
    <form method="post">
        Username <input type="text" name="email" id="email"><br/>
        <!-- Password is php123 -->
        Password <input type="password" name="pass" id="pass"><br/> 
        <input type="submit" value="Log In">
        <input type="button" onclick="location.href='index.php'; return false;" value="Cancel">
    </form>
</body>
</html>